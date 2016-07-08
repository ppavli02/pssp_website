<?php

require "MySqlConnect.php";
$Model = $conn->prepare("SELECT title FROM model");
$Model->execute();

$ResultModel = $Model->fetchAll(PDO::FETCH_ASSOC);


?>