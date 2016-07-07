<?php
/**
 * Created by PhpStorm.
 * User: Irene
 * Date: 12-Jan-16
 * Time: 1:42 PM
 */
require "MySqlConnect.php";
$Model = $conn->prepare("SELECT title FROM model");
$Model->execute();

$ResultModel = $Model->fetchAll(PDO::FETCH_ASSOC);

//
//$TrainAlgorithm = $conn->prepare("SELECT title FROM train_algorithm");
//$TrainAlgorithm->execute();
//
//$ResultTrainAlgorithm = $TrainAlgorithm->fetchAll(PDO::FETCH_ASSOC);
//
//
//$TestSet = $conn->prepare("SELECT title FROM testset");
//$TestSet->execute();
//$ResultTestSet = $TestSet->fetchAll(PDO::FETCH_ASSOC);


?>