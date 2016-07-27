<?php

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
$token = md5(uniqid(rand(),1));
$newFile = 'parameter'.$token.'txt';
//$myFile = fopen($newFile, "w") or die("Unable to open file!");
$file = "/tmp/newfile.txt";

if( !($fd = fopen($file,"w")) )
    die("Could not open $file!");

//$myFile = fopen("newfile.txt", "w") or die("Unable to open file!");
if ($network==1){
    $txt = 'BRNNE-BPTT'."\n";
//    fwrite($fd, $txt);
    }

$form_errors = array();
$countLayers = 0;
foreach($no_neurons as $layer_neurons) {
    //Check no_neurons validity - Error 1
    {
        $re = "/\\d/";
        if (!preg_match($re,$layer_neurons)) {
            array_push($form_errors,"1");
        }
    }

    //Check prev_layers validity - Error 2
    $previous_layers = $prev_layers[$countLayers];
    if ($previous_layers==""){
        $previous_layers='-';
        }
    else{
        $re = "/\\d,\\s/";
        if (!preg_match($re,$previous_layers)) {
            array_push($form_errors,"2");
        }
    }

    //Check next_layers validity - Error 3
    $following_layers = $next_layers[$countLayers];
    if ($following_layers==""){
        $following_layers='-';
        }
    else{
        $re = "/\\d,\\s/";
        if (!preg_match($re,$following_layers)) {
            array_push($form_errors,"3");
        }
    }


    $txt.='Layer '.$countLayers.':'.$layer_neurons.':'.$previous_layers."\n";
    $countLayers++;
}



if (!empty($form_errors)){
    echo json_encode($form_errors);
    return;
}
else{
    fwrite($fd, $txt);
    fclose($fd);
}





//phpinfo( );
