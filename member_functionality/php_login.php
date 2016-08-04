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

$form_errors = array();

try {
    $stmt = $conn->prepare("SELECT * FROM `USER` WHERE `email`='$username' AND `password`='$password'");
    $stmt->execute();

    if (!$stmt->rowCount()){
        #Error 2: Member not found.
        array_push($form_errors, "2");
    }
    else{
        $row = $stmt->fetchAll();

        $user_id = $row[0]['id'];
        $user_firstname = $row[0]['firstname'];
        $user_email = $row[0]['email'];
        $user_accountType = $row[0]['accountType'];
        $timesVisited = $row[0]['timesVisited'];
        if ($user_accountType == 'UNKNOWN') {
            #Error 1: The member has not been verified yet.
            array_push($form_errors, "1");
        }else{
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_email"] = $user_email;
            $_SESSION["user_accountType"] = $user_accountType;
            $_SESSION["isLoggedIn"] = 1;
            header("location:../index.php");
        }
    }

} catch (PDOException $e) {
    array_push($form_errors, "3");
}

$conn = null;

function strip_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



