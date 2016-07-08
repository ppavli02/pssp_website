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

    $username=$json_decoded->{'username_login'};
    $username = stripslashes($username);
    $username = mysql_real_escape_string($username);

    $password=$json_decoded->{'password_login'};
    $password = stripslashes($password);
    $password = mysql_real_escape_string($password);
    $password=md5($password);

    try {
        $stmt = $conn->prepare("SELECT * FROM `USER` WHERE `email`='$username' AND `password`='$password'");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount()) {
            $_SESSION['isLoggedIn'] = 1;
            }
        else{
            echo '1';
            }

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;



