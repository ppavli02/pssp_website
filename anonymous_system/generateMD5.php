<?php 

$token = md5(uniqid(rand(),1));

$results = "";

require("../MySqlConnect.php");

try {
    $sql = "INSERT INTO `PENDING_RESULTS` (`id`, `results`)
        VALUES ('$token', '$results')";
    $conn->exec($sql);
    echo $token;
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>