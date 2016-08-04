<?php
session_start();
$msa_training_file = $_FILES["msa_training_file"]["name"];
$msa_testing_file = $_FILES["msa_testing_file"]["name"];

testZipFile("msa_testing_file");

function testZipFile($file){
    $filename = $_FILES[$file]["name"];
    try {
        // Check $_FILES[<filename>]['error'] value.
        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('Error with ' . $file . ': No file sent.'."\n");
            default:
                throw new RuntimeException('Error with ' . $file . ': Unknown errors.'."\n");
        }
        //Check filesize
        if ($_FILES[$file]['size'] > 20000000) {
            throw new RuntimeException('Error with ' . $filename . ': Exceeded filesize limit.'."\n");
        }

        $type = $_FILES[$file]["type"];
        $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
        $okay = false;
        foreach($accepted_types as $mime_type) {
            if($mime_type == $type) {
                $okay = true;
                break;
            }
        }
        if (!$okay){
            throw new RuntimeException('Invalid file type.'."\n");
        }
    } catch (RuntimeException $e) {
        global $flag;
        $flag = false;
        echo $e->getMessage();
    }
}


if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];


    $name = explode(".", $filename);


    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

    $target_path = "/webserver/trainingFiles/".$filename;  // change this to the correct site path
    if(move_uploaded_file($source, $target_path)) {
        $zip = new ZipArchive();
        $x = $zip->open($target_path);
        if ($x === true) {

            $zip->extractTo("/home/var/yoursite/httpdocs/"); // change this to the correct site path
            $zip->close();

            unlink($target_path);
        }
        $message = "Your .zip file was uploaded and unpacked.";
    } else {
        $message = "There was a problem with the upload. Please try again.";
    }
}

function uploadZipFile($file, $target_dir){
    $fileType = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
    $token = $_SESSION["token"];
    $filename = $file . "_" . $token . "." . $fileType;
    $target_file = $target_dir . $filename;

    if (!file_exists($target_file)) {
        try {
            if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
                $zip = new ZipArchive();
                $x = $zip->open($target_dir);
                if ($x === true) {

                    $zip->extractTo($target_dir); // change this to the correct site path
                    $zip->close();

                    unlink($target_dir);
                }
                $message = "Your .zip file was uploaded and unpacked.";
            }
            else{
                $message = "There was a problem with the upload. Please try again.";
            }
        } catch (RuntimeException $p) {
            global $flag;
            $flag = false;
            echo $p->getMessage();
        }
    }
}