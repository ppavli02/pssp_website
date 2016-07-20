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
    <link rel="stylesheet" href="../css/build_dialog.css"/>
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
    <script type="text/javascript" src="handleForm.js"></script>
    <script type="text/javascript" src="test.js"></script>
    <!--    <script src="../js/runAlgorithm.js"></script>-->
    <!--    <script src="../handleIndex.js"></script>-->

    <!-- Tests -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>


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

    <!--     Banner -->
    <section id="banner">
        <div class="content">
            <form id="myform">
                <div class="row uniform 50%">
                    <header class="major 12u$">
                        <h2>Build Your Own Network</h2>
                    </header>

                    <div id="dialog" title="Tab data">
                        <form>
                            <fieldset class="ui-helper-reset">
                                <label for="tab_title">Title</label>
                                <input type="text" name="tab_title" id="tab_title" value="Tab Title" class="ui-widget-content ui-corner-all">
                                <label for="tab_content">Content</label>
                                <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all">Tab content</textarea>
                            </fieldset>
                        </form>
                    </div>

                    <button id="add_tab">Add Tab</button>

                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Nunc tincidunt</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
                        </ul>
                        <div id="tabs-1">
                            <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                        </div>
                    </div>

                    <div class="container">
                        <form>
                            <!-- Row 1 -->
                            <div class="form-group row">
                                <label class="col-md-2" for="network">Network</label>
                                <div class="col-md-2">
                                    <select id="network" name="network" class="form-control">
                                        <option value="1">BRNN</option>
                                    </select>
                                </div>

                                <!-- Layers -->
                                <label class="col-md-2" for="no_layers">No. of Layers</label>
                                <div class="col-md-2">
                                    <select id="no_layers" name="no_layers" class="form-control" onchange="createCarousel()">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>

                                <!-- Max Iterations -->
                                <label class="col-md-2" for="iterations">Max Iterations</label>
                                <div class="col-md-2">
                                    <input id="iterations" name="iterations" placeholder="100"
                                           class="form-control input-md" required="" type="text">
                                </div>

                            </div>





                            <!-- Row 6 -->
                            <div class="form-group row top-buffer">
                                <!-- Training File -->
                                <label class="col-md-2" for="training_file">Training File</label>
                                <div class="col-md-4">
                                    <input id="training_file" name="training_file" class="input-file" type="file">
                                </div>


                                <!-- Testing File -->
                                <label class="col-md-2" for="testing_file">Testing File</label>
                                <div class="col-md-4">
                                    <input id="testing_file" name="testing_file" class="input-file" type="file">
                                </div>
                            </div>



                        </form>
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


