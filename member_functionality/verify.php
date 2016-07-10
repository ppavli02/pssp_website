<?php

$token = $_GET['q'];

require("../MySqlConnect.php");


try {
    $stmt = $conn->prepare("SELECT * FROM `USER` WHERE `verification`='$token'");
    $stmt->execute();

    if (!$stmt->rowCount()) {
        echo "No such member.";
        exit;
    }

    $result = $stmt->fetchColumn(7);
    if ($result=='ADV'){
        echo "This member has already been verified.";
    }
    else{
        $stmt = $conn->prepare("UPDATE `USER` SET `accountType`='ADV' WHERE `verification`='$token'");
        $stmt->execute();
        echo "SUCCESS.";
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
