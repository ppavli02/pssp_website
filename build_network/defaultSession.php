/**
* User: ppavli02
* Date: July - August 2016
* Comment: This php file copies the default parameter, located in /webserver/,
* and places it in the parameterFiles folder with its new identity. Also, it
* replaces the lines in the file which refer to the training and testing files.
*
* Returns:  1 - if an exception is fired.
*           2 - if everything is ok.
*/

<?php
session_start();

$token = md5(uniqid(rand(), 1));
$_SESSION["token"]=$token;

$from_path = "/webserver/parameters.txt";
$to_path = "/webserver/parameterFiles/parameter_".$token.".txt";

$returnValue=1;

if (copy($from_path, $to_path)){
    $_SESSION["token"]=$token;

    try{
        $fname = $to_path;
        $fhandle = fopen($fname,"r");
        $content = fread($fhandle,filesize($fname));

        $content = str_replace("train_File trainSet.txt", "train_File fasta_training_".$token.".txt", $content);
        $content = str_replace("test_File testSet.txt", "test_file fasta_testing_".$token.".txt", $content);

        $fhandle = fopen($fname,"w");
        fwrite($fhandle,$content);
        fclose($fhandle);

        $returnValue = 2;

    }catch (RuntimeException $e) {
        $returnValue = 1;
    }
}
else{
    $returnValue = 1;
}

echo $returnValue;
