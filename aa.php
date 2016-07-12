<?php

//$a = test_input(' Panayiotis');
//echo $a;
//
//function test_input($data) {
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
//}

$form_errors = array();
$s = isset($form_errors);
//echo $s;
array_push($form_errors,"2");
$s = empty($form_errors);
echo $s;