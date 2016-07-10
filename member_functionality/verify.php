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

    $result = $stmt->fetchColumn(1);

    $stmt = $conn->prepare("UPDATE `USER` SET `accountType`='ADV' WHERE `verification`='$token'");
    $stmt->execute();


}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
echo "SUCCESS.";



