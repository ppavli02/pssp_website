<?php
/**
 * User: ppavli02
 * Date: July - August 2016
 * Comment: This php file uploads the files to the server. First, it checks if
 * files already exist in the given folder, then it testes if those files
 * fire some errors based on the $_FILES[<name>]['error'] attribute and finally
 * uploads the file. If something goes wrong at any point it returns an
 * exception.
 *
 * Returns: Exceptions. See the code (it is self explained).
 */


$flag = true;

//Test if files exist.
$token = md5(uniqid(rand(),1));

$fasta_dir="/webserver/model_trained/tmp_uploaded_files/fasta/";
$msa_dir="/webserver/model_trained/tmp_uploaded_files/msa/";

$fasta_testing_path=$fasta_dir.$token.".txt";
$msa_testing_path=$msa_dir.$token.".zip";

if (file_exists($fasta_testing_path) || file_exists($msa_testing_path)){
    echo "Files are already on server.";
    exit;
}

if($flag){
    testFile("run_fasta_testing");
    testZipFile("run_msa_testing");
}


if (flag) {
    uploadFile("run_fasta_testing", $fasta_dir);
}
if (flag) {
    uploadFile("run_msa_testing", $msa_dir);
}

if ($flag) {
    echo $token;
}

function testFile($file){
    try {
        // Check $_FILES[<filename>]['error'] value.
        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException(' No file/s sent.' . "\n");
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Some of the files exceeded file size limit.' . "\n");
            default:
                throw new RuntimeException('Unknown errors.' . "\n");
        }
        //Check filesize
        if ($_FILES[$file]['size'] > 1000000) {
            throw new RuntimeException('One or more files exists the file size limit.' . "\n");
        }
        if ($_FILES[$file]['type'] != "text/plain") {
            throw new RuntimeException(' Please provide file/s.' . "\n");
        }
    } catch (RuntimeException $e) {
        global $flag;
        $flag = false;
        echo $e->getMessage();
        exit;
    }
}

function testZipFile($file){
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
        exit;
    }
}

function uploadFile($file, $target_dir)
{
    $fileType = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
    if ($fileType!="zip")
        $fileType="txt";
    global $token;
    $filename = $token . "." . $fileType;
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
            exit;
        }
    }
}
