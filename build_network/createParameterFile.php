<?php

$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

$username = $json_decoded->{'username_login'};
$username = strip_input($username);

$password = $json_decoded->{'password_login'};
$password = strip_input($password);
