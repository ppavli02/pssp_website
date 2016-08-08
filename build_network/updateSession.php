<?php
session_start();
$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

$token = $json_decoded->{'md5'};
$parameter_path="/webserver/parameterFiles/parameter_".$token.".txt";

if (file_exists($parameter_path)){
    $_SESSION["token"]=$token;
    if (!isset($_SESSION["token"])){
        echo "1";
    }
    else{
        echo "3";
    }
}else{
    echo "2";
}

