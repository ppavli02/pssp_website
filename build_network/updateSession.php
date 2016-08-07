<?php
session_start();
$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

//echo json_encode($form_errors);
$token = $json_decoded->{'md5'};
$_SESSION["token"]=$token;
if (!isset($_SESSION["token"])){
    echo "1";
}
else{
    echo "2";
}
