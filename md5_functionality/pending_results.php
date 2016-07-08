<?php

    require("../MySqlConnect.php");


    try {
        $stmt = $conn->prepare("SELECT * FROM `PENDING_RESULTS`");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $affectedRows = $stmt->rowCount();
        echo $affectedRows;


    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;



