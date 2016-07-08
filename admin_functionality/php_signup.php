<?php
    $json_encoded = file_get_contents('php://input');
    $json_decoded = json_decode($json_encoded);


    $firstname=$json_decoded->{'user_firstname'};
    $lastname=$json_decoded->{'user_lastname'};
    $user_username=$json_decoded->{'user_username'};
    $user_password=$json_decoded->{'user_password'};
    $user_repeat_password=$json_decoded->{'user_repeat_password'};
    $timesVisited=0;


    if (strcmp("$user_repeat_password","$user_password")!=0){
        echo "2";
        return;
    }

    $user_password = md5($user_password);
      
    require("../MySqlConnect.php");


    try {
        $sql = "INSERT INTO `USER` (`firstname`, `lastname`, `email`, `password`, `timesVisited`)
        VALUES ('$firstname', '$lastname', '$user_username', '$user_password', '$timesVisited')";
        $conn->exec($sql);
        echo "New record created successfully";
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;