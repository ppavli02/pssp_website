<?php
/**
 * Created by PhpStorm.
 * User: Irene
 * Date: 12-Jan-16
 * Time: 3:24 PM
 */

//let's start the session
session_start();
//finally, let's store our posted values in the session variables


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = test_input($_GET["selModel"]);
    $tAlgorithm = test_input($_GET["selTalgorithm"]);
    //$train = test_input($_GET["selTalgorithm"]);
    $test = test_input($_GET["selTest"]);
    print $test;
    $_SESSION['model'] = $model;
    $_SESSION['tAlgorithm'] = $tAlgorithm;
    //$_SESSION['train'] = $train;
    $_SESSION['test'] = $test;

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Material Login Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/style.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
    <script src="js/handleRegistration.js"></script>
    <script src="js/handleLogIn.js"></script>

</head>
<body>

<div class="rerun"><a href="">Rerun Pen</a></div>
<div class="container">
    <div class="card"></div>
    <div class="card">
        <h1 class="title">Session</h1>

        <!--Choose Model/Training Algorithm Form-->

        <form id="createNetwork_form" >
            <p><?php echo $_SESSION['model']?></p>
            <p><?php echo $_SESSION['tAlgorithm']?></p>
           <!-- <p><?php /*echo $_SESSION['train']*/?></p>-->
            <p><?php echo $_SESSION['test']?></p>
        </form>
    </div>

</div>

<!--<a id="portfolio" href="http://andytran.me/" title="View my portfolio!"><i class="fa fa-link"></i></a>-->
<!--<a id="codepen" href="http://codepen.io/andytran/" title="Follow me!"><i class="fa fa-codepen"></i></a>-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

