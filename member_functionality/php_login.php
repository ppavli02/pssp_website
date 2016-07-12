<?php
/*
   We receive the information from the login form and
   if we can match a member from the database with the
   email and the password, we then start a session with
   these information, else we flash.
*/
session_start();

require("../MySqlConnect.php");

$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

$username = $json_decoded->{'username_login'};
$username = strip_input($username);

$password = $json_decoded->{'password_login'};
$password = strip_input($password);
$password = md5($password);

try {
    $stmt = $conn->prepare("SELECT * FROM `USER` WHERE `email`='$username' AND `password`='$password'");
    $stmt->execute();

    $result = $stmt->fetchColumn(7);
    if ($result == 'UNKNOWN') {
        echo '1';
    } else if ($stmt->rowCount()) {
        $_SESSION['isLoggedIn'] = 1;
    } else {
        echo '2';
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

function strip_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
