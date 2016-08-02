<?php
session_start();
$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

//echo json_encode($form_errors);
$network = $json_decoded->{'network'};
$iterations = $json_decoded->{'iterations'};
$no_neurons = $json_decoded->{'no_neurons'};
$prev_layers = $json_decoded->{'prev_layers'};
$next_layers = $json_decoded->{'next_layer'};
$layer_type = $json_decoded->{'layer_type'};
$error_function = $json_decoded->{'error_function'};
$activation_function = $json_decoded->{'activation_function'};
$learning_rate = $json_decoded->{'learning_rate'};
$momentum = $json_decoded->{'momentum'};
$delay_unit = $json_decoded->{'delay_unit'};
$unknown_flag = $json_decoded->{'unknown_flag'};


//Create File
$token = md5(uniqid(rand(), 1));
$parameterFile = 'parameter_' . $token . '.txt';
$trainingFile = 'training_' . $token . '.txt';
$testingFile = 'testing_' . $token . '.txt';

$file = "/webserver/parameterFiles/".$parameterFile;

if (!($fd = fopen($file, "w")))
    die("Could not open $file!");


if ($network == 1) {
    $txt = 'BRNNE-BPTT' . "\n";
}

$form_errors = array();

$max = sizeof($no_neurons);
for ($countLayers = 0; $countLayers < $max; $countLayers++) {
    //Check no_neurons validity - Error 1
    if ($max == 1) {
        $layer_neurons = $no_neurons;
    } else {
        $layer_neurons = $no_neurons[$countLayers];
    }

    {
        $regEx = "/\\d/";
        if (!preg_match($regEx, $layer_neurons)) {
            if (!in_array("1", $form_errors)) {
                array_push($form_errors, "1");
            }
        }
    }

    //Check prev_layers validity - Error 2
    if ($max == 1) {
        $previous_layers = $prev_layers;
    } else {
        $previous_layers = $prev_layers[$countLayers];
    }

    if ($previous_layers == "") {
        $previous_layers = '-';
    } else {
        $regEx1 = "/\\d,\\s/";
        $regEx2 = "/\\d/";
        if (!preg_match($regEx1, $previous_layers) && !preg_match($regEx2, $previous_layers)) {
            if (!in_array("2", $form_errors)) {
                array_push($form_errors, "2");
            }
        }
        $previous_layers = preg_replace('/\s+/', '', $previous_layers);
    }

    //Check next_layers validity - Error 3
    if ($max == 1) {
        $following_layers = $next_layers;
    } else {
        $following_layers = $next_layers[$countLayers];
    }

    $following_layers = $next_layers[$countLayers];
    if ($following_layers == "") {
        $following_layers = '-';
    } else {
        $regEx1 = "/\\d,\\s/";
        $regEx2 = "/\\d/";
        if (!preg_match($regEx1, $following_layers) && !preg_match($regEx2, $following_layers)) {
            if (!in_array("3", $form_errors)) {
                array_push($form_errors, "3");
            }
        }
        $following_layers = preg_replace('/\s+/', '', $following_layers);
    }

    //Get Layer Type
    $type_of_layer = $layer_type[$countLayers];
    switch ($type_of_layer) {
        case "1":
            $type_of_layer_text = 'I';
            break;
        case "2":
            $type_of_layer_text = 'H';
            break;
        case "3":
            $type_of_layer_text = 'C';
            break;
        case "4":
            $type_of_layer_text = 'O';
            break;
    }

    //Get Error Function
    $error_function_text = $error_function[$countLayers];

    //Get Activation Function
    $activation_function_text = $activation_function[$countLayers];

    //Check learning rate validity - Error 4
    if ($max == 1) {
        $get_learning_rate = $learning_rate;
    } else {
        $get_learning_rate = $learning_rate[$countLayers];
    }

    {
        $regEx1 = "/\\d.\\d/";
        $regEx2 = "/\\d/";
        if (!preg_match($regEx1, $get_learning_rate) && !preg_match($regEx2, $get_learning_rate)) {
            if (!in_array("4", $form_errors)) {
                array_push($form_errors, "4");
            }
        }
    }

    //Check momentum validity - Error 5
    if ($max == 1) {
        $get_momentum = $momentum;
    } else {
        $get_momentum = $momentum[$countLayers];
    }

    {
        $regEx1 = "/\\d.\\d/";
        $regEx2 = "/\\d/";
        if (!preg_match($regEx1, $get_momentum) && !preg_match($regEx2, $get_momentum)) {
            if (!in_array("5", $form_errors)) {
                array_push($form_errors, "5");
            }
        }
    }

    //Check delay unit validity - Error 6
    if ($max == 1) {
        $get_delay_unit = $delay_unit;
    } else {
        $get_delay_unit = $delay_unit[$countLayers];
    }

    {
        $regEx = "/\\d/";
        if (!preg_match($regEx, $get_momentum)) {
            if (!in_array("6", $form_errors)) {
                array_push($form_errors, "6");
            }
        }
    }


    //Get Flag
    $flag = $unknown_flag[$countLayers];
    switch ($flag) {
        case "1":
            $flag_text = 'C';
            break;
        case "2":
            $flag_text = 'B';
            break;
        case "3":
            $flag_text = 'F';
            break;
        case "4":
            $flag_text = 'O';
            break;
    }


    $txt .= 'Layer ' . $countLayers . ':' . $layer_neurons . ':' . $previous_layers . ':' . $following_layers . ':' .
        $type_of_layer_text . ':' . $error_function_text . ':' . $get_learning_rate . ':' . $get_momentum . ':' .
        $get_delay_unit . ':' . $flag_text . "\n";

}

{
    $regEx = "/\\d/";
    if (!preg_match($regEx, $iterations)) {
        if (!in_array("7", $form_errors)) {
            array_push($form_errors, "7");
        }
    }
}

$txt .= "maxIterations ".$iterations."\n";
$txt .= "train_File ". $trainingFile . "\n";
$txt .= "test_file ". $testingFile . "\n";


if (!empty($form_errors)) {
    echo json_encode($form_errors);
    return;
} else {
    fwrite($fd, $txt);
    fclose($fd);
    $_SESSION["token"] = $token;
    echo $token;
}