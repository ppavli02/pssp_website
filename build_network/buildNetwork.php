<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
    echo "<script>flag=true;</script>";
} else {
    echo "<script>flag=false;</script>";
}
include "../setSelectionLists.php";
?>

<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>PSSP by ucy.</title>
    <meta charset="utf-8"/>
    <meta _="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="16x16">
    <!--[if lte IE 8]>
    <script src="../js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/build_main.css"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="../css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="../css/ie8.css"/><![endif]-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--Bootstrap-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--Sweetalert-->
    <script src="../_/libs/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../_/libs/sweetalert/sweetalert.css">
    <!-- My code -->
    <script src="../js/runAlgorithm.js"></script>
    <script src="../handleIndex.js"></script>


</head>
<body class="landing">

<div id="page-wrapper">
    <!-- Header -->
    <header id="header">
        <!--        <h1 id="logo"><a href="index.php">Landed</a></h1>-->
        <nav id="nav">
            <ul>
                <!--                <li><a href="index.php">Home</a></li>-->
                <!--                <li><a href="#"></a></li>-->
                <li><?php
                    if (isset($_SESSION['isLoggedIn'])) {
                        echo $_SESSION['user_email'];
                    }
                    ?></li>
                <li><a href="#four">Help</a></li>
                <!--                <li id="create_network"><a href="./build_network/login.php" class="button special">Log In</a></li>-->
                <!--                <li id="login_btn"><a href="./member_functionality/login.php" class="button special">Log In</a></li>-->
                <li id="login_btn"></li>
            </ul>
        </nav>
    </header>

    <!-- Banner -->
    <section id="banner">
        <div class="content">
            <form id="myform">
                <div class="row uniform 50%">
                    <header class="major 12u$">
                        <h2>Build Your Own Network</h2>
                    </header>
                    <div class="container center_label">
                        <label for="protein">Enter the amino acids of proteins:</label>
                    </div>
                    <div class="container center_input">
                        <div id="div_protein" class="form-group ">
                            <label class="control-label" style="display: none" id="protein_required" for="protein">Required</label>
                            <input type="text" class="form-control" aria-describedby="protein_ErrorStatus"
                                   name="protein" id="protein" value="" placeholder="protein"/>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"
                                  id="protein_xMark" aria-hidden="true"></span>
                            <span id="protein_ErrorStatus" style="display: none" class="sr-only">(error)</span>

                        </div>
                    </div>
                    <div class="container center_label">
                        <label for="Network">Choose Network:</label>
                    </div>
                    <div class="container center_input">
                        <div class="form-group">
                            <div class="select-wrapper">
                                <select name="category" id="category">
                                    <?php $i = 0;
                                    while ($i < count($ResultModel)) { ?>
                                        <option value=""><?php echo $ResultModel[$i]['title']; ?></option>
                                        <?php $i++;
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container center_label">
                        <label for="Testing file">Choose a testing file:</label>
                    </div>
                    <div class="container center_input">
                        <div class="form-group">
                            <input type="file" name="testingUpload" id="testingUpload">
                        </div>
                    </div>
                    <div class="12u$">
                        <ul class="actions">
                            <li><input type="reset" id="reset1" value="Reset"/></li>
                            <li><a href="#banner" id="results" class="button ">Get Results</a></li>
                        </ul>
                    </div>

                </div>
            </form>
        </div>
    </section>

</div>


<script src="../js/core_js/jquery.scrolly.min.js"></script>
<script src="../js/core_js/jquery.dropotron.min.js"></script>
<script src="../js/core_js/jquery.scrollex.min.js"></script>
<script src="../js/core_js/skel.min.js"></script>
<script src="../js/core_js/util.js"></script>
<!--[if lte IE 8]>
<script src="../js/ie/respond.min.js"></script><![endif]-->
<script src="../js/core_js/main.js"></script>


</body>
</html>