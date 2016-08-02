<?php

$fasta_training_file = $_FILES["fasta_training_file"]["name"];
$fasta_testing_file = $_FILES["fasta_testing_file"]["name"];
$msa_training_file = $_FILES["msa_training_file"]["name"];
$msa_testing_file = $_FILES["msa_testing_file"]["name"];
//$token = $_POST["token"];

//echo $_FILES["fasta_training_file"]['name'];
//$a="fasta_training_file";
//, "/webserver/trainingFiles/"
$flag = true;
testFile("fasta_training_file");
testFile("fasta_testing_file");
testFile("msa_training_file");
testFile("msa_testing_file");

if (flag) {
    uploadFile("fasta_training_file", "/webserver/trainingFiles/");
}
if (flag) {
    uploadFile("fasta_testing_file", "/webserver/testingFiles/");
}
if (flag) {
    uploadFile("msa_training_file", "/webserver/trainingFiles/");
}
if (flag) {
    uploadFile("msa_testing_file", "/webserver/testingFiles/");
}


function testFile($file){
    $filename = $_FILES[$file]["name"];
    try {
        // Check $_FILES[<filename>]['error'] value.
        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('Error with ' . $filename . ': No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Error with ' . $filename . ': Exceeded file size limit.');
            default:
                throw new RuntimeException('Error with ' . $filename . ': Unknown errors.');
        }
        //Check filesize
        if ($_FILES[$file]['size'] > 1000000) {
            throw new RuntimeException('Error with ' . $filename . ': Exceeded filesize limit.');
        }
        if ($_FILES[$file]['type'] != "text/plain") {
            throw new RuntimeException('Error with ' . $filename . ': Please provide a text file.');
        }
    } catch (RuntimeException $e) {
        global $flag;
        $flag = false;
        echo $e->getMessage();
    }
}

function uploadFile($file, $target_dir){
    $fileType = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
    $token = $_SESSION["token"];
    $filename = $file . "_" . $token . "." . $fileType;
    $target_file = $target_dir . $filename;

    if (!file_exists($target_file)) {
        try {
            if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES[$file]["name"]) . " has been uploaded.";
            } else {
                throw new RuntimeException("Sorry, there was an error uploading your file.");
            }
        } catch (RuntimeException $p) {
            global $flag;
            $flag = false;
            echo $p->getMessage();
        }
    }

}

//function uploadFile($file, $target_dir){
//    $fileType = pathinfo($_FILES[$file]["name"],PATHINFO_EXTENSION);
//    $token = $_POST["token"];
//    $filename = $file . "_" . $token.".".$fileType;
//    $target_file = $target_dir . $filename;
//    try {
//        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
//            echo "The file " . basename($_FILES[$file]["name"]) . " has been uploaded.";
//        } else {
//            throw new RuntimeException("Sorry, there was an error uploading your file.");
//        }
//    }
//    catch (RuntimeException $p){
//        global $flag;
//        $flag=false;
//        echo $p->getMessage();
//    }
//}
