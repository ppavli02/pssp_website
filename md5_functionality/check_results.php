<?php

    $token = $_GET['q'];

    require("../MySqlConnect.php");


    try {
        $stmt = $conn->prepare("SELECT * FROM `PENDING_RESULTS` WHERE `id`='$token'");
        $stmt->execute();

//        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt->rowCount()) {
            echo "No such id.";
            exit;
        }

        $result = $stmt->fetchColumn(1);

        if ($result == ""){
            echo "Results are not yet ready.";
            exit;
            }
        else{
//            echo $result;
            $file = "/tmp/".$token.".txt";
            if( !($fd = fopen($file,"a")) )
                die("Could not open $file!");

            if( !(flock($fd,LOCK_EX)) )
                die("Could not aquire exclusive lock on $file!");

            if( !(fwrite($fd,$result."\n")) )
                die("Could not write to $file!");

            if( !(flock($fd,LOCK_UN)) )
                die("Could not release lock on $file!");

            if( !(fclose($fd)) )
                die("Could not close file pointer for $file!");
            echo "Thank you!";
        }


    #if all above were successful
//        try {
//            // sql to delete a record
//            if ($result != "Results are not yet ready."){
//                $sql = "DELETE FROM `PENDING_RESULTS` WHERE `id`='$token'";
//                $conn->exec($sql);
//            }
//        }
//        catch(PDOException $e)
//        {
//            echo $sql . "<br>" . $e->getMessage();
//        }

        $conn = null;



    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;



