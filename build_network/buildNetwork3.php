<?php
session_start();
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: ../index.php");
}
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
    <link rel="stylesheet" href="../css/form.css"/>
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
    <!--Bootstrap Switch-->
    <script src="../_/libs/bootstrap_switch/bootstrap-switch.js"></script>
    <link rel="stylesheet" type="text/css" href="../_/libs/bootstrap_switch/bootstrap-switch.css">
    <!-- My code -->
    <script type="text/javascript" src="handleForm.js"></script>


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
                <li><a href="../index.php">Home</a></li>
                <!--                <li id="create_network"><a href="./build_network/login.php" class="button special">Log In</a></li>-->
                <!--                <li id="login_btn"><a href="./member_functionality/login.php" class="button special">Log In</a></li>-->
                <li id="login_btn"><a href="../member_functionality/logout.php" class="button special">Log Out</a></li>
            </ul>
        </nav>
    </header>


    <!--     Banner -->
    <section id="banner">
        <div class="content">
            <!--            <form id="myform" enctype="multipart/form-data" action="aa.php" method="post">-->
            <!--            <form id="myform" enctype="multipart/form-data" method="post">-->

            <!--            <form id="myform" enctype="multipart/form-data" onsubmit="buildTheNetwork()">-->
            <form id="myform" enctype="multipart/form-data">
                <!--            <form id="myform">-->
                <div class="row uniform 50%">
                    <header class="major 12u$">
                        <h2>Build Your Own Network</h2>
                    </header>

                    <div class="container">
                        <div id="wizard_div_1">
                            <label for="wizard_1" class="col-md-4">Use the default parameter file:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <div class="col-md-1">
                                <input type="checkbox" name="wizard_1" data-on-color="primary"
                                       data-off-color="warning"
                                       checked>
                            </div>
                        </div>

                        <div id="wizard_div_2" class="form-group row">
                            <label for="md5_code" class="col-md-4">I have a unique code to retrieve parameter
                                file:</label>
                            <div class="col-md-1">
                                <input type="checkbox" name="wizard_2" data-on-color="primary"
                                       data-off-color="warning"
                                       checked>
                            </div>
                            <div class="col-md-2 col-md-offset-1">
                                <input id="md5_code" name="md5_code"
                                       placeholder="45kjhdsf5i342"
                                       class="form-control input-md" type="text">
                            </div>
                        </div>

                        <form>
                            <!-- Row 1 -->
                            <div class="form-group row top-buffer">
                                <!-- Training File -->
                                <label class="col-md-2" for="fasta_training_file">Fasta Training File</label>
                                <div class="col-md-4">
                                    <!--                                    <input id="training_file" name="training_file" class="input-file" type="file">-->
                                    <input type="file" name="fasta_training_file" class="input-file"
                                           id="fasta_training_file">
                                </div>

                                <!-- Testing File -->
                                <label class="col-md-2" for="fasta_testing_file">Fasta Testing File</label>
                                <div class="col-md-4">
                                    <input id="fasta_testing_file" name="fasta_testing_file" class="input-file"
                                           type="file">
                                </div>
                            </div>

                            <!-- Row 2 -->
                            <div class="form-group row">
                                <!-- Training File -->
                                <label class="col-md-2" for="msa_training_file">MSA Training File</label>
                                <div class="col-md-4">
                                    <!--                                    <input id="training_file" name="training_file" class="input-file" type="file">-->
                                    <input type="file" name="msa_training_file" class="input-file"
                                           id="msa_training_file">
                                </div>


                                <!-- Testing File -->
                                <label class="col-md-2" for="msa_testing_file">MSA Testing File</label>
                                <div class="col-md-4">
                                    <input id="msa_testing_file" name="msa_testing_file" class="input-file" type="file">
                                </div>
                            </div>

                            <!-- Row 3 -->
                            <div class="virtual_box form-group row top-buffer">
                                <label class="col-md-2" for="network">Model</label>
                                <div class="col-md-2">
                                    <select id="network" name="network" class="form-control">
                                        <option value="1">BRNN</option>
                                    </select>
                                </div>

                                <!-- Layers -->
                                <label class="col-md-1" for="no_layers">Layers</label>
                                <label class="col-md-1" for="no_layers" id="layers_layer">1</label>
                                <input class="btn btn-primary col-md-offset-1 col-md-1" type="button" value="+"
                                       onclick="createCarousel()">

                                <!-- Max Iterations -->
                                <label class="col-md-2" for="iterations">Max Iterations</label>
                                <div class="col-md-2">
                                    <input id="iterations" name="iterations" placeholder="100"
                                           class="form-control input-md" required="" type="text">
                                </div>

                            </div>


                            <div class="form-group row">
                                <img class="col-md-12" src="../_/img/line.png" alt="line">
                            </div>

                        </form>

                        <div id="formCarousel" class="virtual_box carousel slide" data-ride="carousel" data-interval="false">
                            <!-- Indicators -->
                            <ol class="carousel-indicators" id="carouselIndicators">
                                <li data-target="#formCarousel" data-slide-to="0" class="active"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div id="tab1" class="item active">
                                    <form>
                                        <!-- Row 4 -->
                                        <div class="form-group row top-buffer">

                                            <!-- No of Neurons -->
                                            <label class="col-md-2" for="no_neurons">No. of Neurons</label>
                                            <div class="col-md-2">
                                                <input id="no_neurons" name="no_neurons" placeholder="60"
                                                       class="form-control input-md no_neurons" required="" type="text">

                                            </div>

                                            <!-- Prev. Layers -->
                                            <label class="col-md-2" for="prev_layers">Previous Layers</label>
                                            <div class="col-md-2">
                                                <input id="prev_layers" name="prev_layers" placeholder="1, 3"
                                                       class="form-control input-md prev_layers" required=""
                                                       type="text">
                                            </div>

                                            <!-- Next Layer -->
                                            <label class="col-md-2" for="next_layer">Next Layers</label>
                                            <div class="col-md-2">
                                                <input id="next_layer" name="next_layer" placeholder="2, 5"
                                                       class="form-control input-md next_layer" required="" type="text">
                                            </div>
                                        </div>

                                        <!-- Row 5 -->
                                        <div class="form-group row top-buffer">
                                            <!-- Flag -->
                                            <label class="col-sm-2" for="layer_type">Layer Type</label>
                                            <div class="col-sm-2">
                                                <select required id="layer_type" name="layer_type"
                                                        class="form-control layer_type">
                                                    <option value="">None</option>
                                                    <option value="1">Input</option>
                                                    <option value="2">Hidden</option>
                                                    <option value="3">Context</option>
                                                    <option value="4">Output</option>
                                                </select>
                                            </div>

                                            <!-- Error Function -->
                                            <label class="col-sm-2" for="error_function">Error Function</label>
                                            <div class="col-sm-2">
                                                <select id="error_function" name="error_function"
                                                        class="form-control error_function" required>
                                                    <option value="">None</option>
                                                    <option value="1">Gaussian</option>
                                                    <option value="2">Ln</option>
                                                </select>
                                            </div>

                                            <!-- Activation Function -->
                                            <label class="col-sm-2" for="activation_function">Activation
                                                Function</label>
                                            <div class="col-sm-2">
                                                <select required id="activation_function" name="activation_function"
                                                        class="form-control activation_function">
                                                    <option value="">None</option>
                                                    <option value="1">Sigmoid</option>
                                                    <option value="2">ReLU</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Row 6 -->
                                        <div class="form-group row top-buffer">
                                            <!-- Learning Rate -->
                                            <label class="col-md-2" for="learning_rate">Learning Rate</label>
                                            <div class="col-md-2">
                                                <input id="learning_rate" name="learning_rate" placeholder="0.1"
                                                       class="form-control input-md learning_rate" required=""
                                                       type="text">
                                            </div>

                                            <!-- Momentum -->
                                            <label class="col-md-2" for="momentum">Momentum</label>
                                            <div class="col-md-2">
                                                <input id="momentum" name="momentum" placeholder="0.1"
                                                       class="form-control input-md momentum"
                                                       required="" type="text">
                                            </div>

                                            <!-- Delay Unit -->
                                            <label class="col-md-2" for="delay_unit">Delay Unit</label>
                                            <div class="col-md-2">
                                                <input id="delay_unit" name="delay_unit" placeholder="1"
                                                       class="form-control input-md delay_unit" required="" type="text">
                                            </div>
                                        </div>

                                        <!-- Row 7 -->
                                        <div class="form-group row top-buffer">


                                            <!-- Flag -->
                                            <label class="col-md-2" for="unknown_flag">Flag</label>
                                            <div class="col-md-2">
                                                <select required id="unknown_flag" name="unknown_flag"
                                                        class="form-control unknown_flag">
                                                    <option value="">None</option>
                                                    <option value="1">Center</option>
                                                    <option value="2">Backward</option>
                                                    <option value="3">Forward</option>
                                                    <option value="4">Output</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div id="tab2"></div>
                                <div id="tab3"></div>
                                <div id="tab4"></div>
                                <div id="tab5"></div>
                                <div id="tab6"></div>
                                <div id="tab7"></div>
                                <div id="tab8"></div>
                                <div id="tab9"></div>
                                <div id="tab10"></div>

                            </div>



                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#formCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#formCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div>
                            <div></div>
                            <!--                                <input class="btn btn-primary" type="submit" value="Submit">-->
                            <input class="btn btn-primary" value="Submit" onclick="buildTheNetwork()">
                        </div>


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


