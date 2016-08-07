<?php
session_start();

$flag = true;
testFile("fasta_training_file");
testFile("fasta_testing_file");
testZipFile("msa_training_file");
testZipFile("msa_testing_file");

$token = $_SESSION["token"];
if ($flag){
    $tr_dir = "/webserver/trainingFiles/" . $token . "/";
    if (is_dir($tr_dir) === false) {
        mkdir($tr_dir);
    }else{
        $flag=false;
    }

    $ts_dir = "/webserver/testingFiles/" . $token . "/";
    if (is_dir($ts_dir) === false) {
        mkdir($ts_dir);
    }else{
        $flag=false;
    }
}


if (flag) {
    uploadFile("fasta_training_file", $tr_dir);
}
if (flag) {
    uploadFile("fasta_testing_file", $ts_dir);
}
if (flag) {
    uploadFile("msa_training_file", $tr_dir);
}
if (flag) {
    uploadFile("msa_testing_file", $ts_dir);
}

if ($flag) {
    echo $flag;
}

function testFile($file)
{
    $filename = $_FILES[$file]["name"];
    try {
        // Check $_FILES[<filename>]['error'] value.
        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('Error with ' . $file . ': No file sent.' . "\n");
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Error with ' . $file . ': Exceeded file size limit.' . "\n");
            default:
                throw new RuntimeException('Error with ' . $file . ': Unknown errors.' . "\n");
        }
        //Check filesize
        if ($_FILES[$file]['size'] > 1000000) {
            throw new RuntimeException('Error with ' . $filename . ': Exceeded filesize limit.' . "\n");
        }
        if ($_FILES[$file]['type'] != "text/plain") {
            throw new RuntimeException('Error with ' . $filename . ': Please provide a text file.' . "\n");
        }
    } catch (RuntimeException $e) {
        global $flag;
        $flag = false;
        echo $e->getMessage();
    }
}

function testZipFile($file)
{
    $filename = $_FILES[$file]["name"];
    try {
        // Check $_FILES[<filename>]['error'] value.
        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('Error with ' . $file . ': No file sent.' . "\n");
            default:
                throw new RuntimeException('Error with ' . $file . ': Unknown errors.' . "\n");
        }
        //Check filesize
        if ($_FILES[$file]['size'] > 20000000) {
            throw new RuntimeException('Error with ' . $filename . ': Exceeded filesize limit.' . "\n");
        }

        $type = $_FILES[$file]["type"];
        $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
        $okay = false;
        foreach ($accepted_types as $mime_type) {
            if ($mime_type == $type) {
                $okay = true;
                break;
            }
        }
        if (!$okay) {
            throw new RuntimeException('Invalid file type.' . "\n");
        }
        $fileType = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
        if ($fileType != "zip") {
            throw new RuntimeException('Invalid file type. ' . $fileType . "\n");
        }
    } catch (RuntimeException $e) {
        global $flag;
        $flag = false;
        echo $e->getMessage();
    }
}

function uploadFile($file, $target_dir)
{
    $fileType = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
    if ($fileType!="zip")
        $fileType="txt";
    $token = $_SESSION["token"];
    $filename = $file . "_" . $token . "." . $fileType;
    $target_file = $target_dir . $filename;
    if (!file_exists($target_file)) {
        try {
            if (!move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
                throw new RuntimeException("Sorry, there was an error uploading your file." . "\n");
            }
        } catch (RuntimeException $p) {
            global $flag;
            $flag = false;
            echo $p->getMessage();
        }
    }
}

//function uploadZipFile($file, $target_dir){
//    $fileType = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
//    $token = $_SESSION["token"];
//    $filename = $file . "_" . $token . "." . $fileType;
//    $target_file = $target_dir . $filename;
//
//    if (!file_exists($target_file)) {
//        try {
//            if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
//                $zip = new ZipArchive();
//                $x = $zip->open($target_dir);
//                if ($x === true) {
//
//                    $zip->extractTo($target_dir); // change this to the correct site path
//                    $zip->close();
//
//                    unlink($target_dir);
//                }
//                $message = "Your .zip file was uploaded and unpacked.";
//                throw new RuntimeException($message);
//            }
//            else{
//                $message = "There was a problem with the upload. Please try again.";
//                throw new RuntimeException($message);
//            }
//        } catch (RuntimeException $p) {
//            global $flag;
//            $flag = false;
//            echo $p->getMessage();
//        }
//    }
//}
