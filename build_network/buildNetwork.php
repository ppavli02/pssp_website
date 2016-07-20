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

    <!--     Banner -->
    <section id="banner">
        <div class="content">
            <form id="myform">
                <div class="row uniform 50%">
                    <header class="major 12u$">
                        <h2>Build Your Own Network</h2>
                    </header>
<!--                    <div class="container center_label">-->
<!--                        <label for="protein">Enter the amino acids of proteins:</label>-->
<!--                    </div>-->
<!--                    <div class="container center_input">-->
<!--                        <div id="div_protein" class="form-group ">-->
<!--                            <label class="control-label" style="display: none" id="protein_required" for="protein">Required</label>-->
<!--                            <input type="text" class="form-control" aria-describedby="protein_ErrorStatus"-->
<!--                                   name="protein" id="protein" value="" placeholder="protein"/>-->
<!--                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"-->
<!--                                  id="protein_xMark" aria-hidden="true"></span>-->
<!--                            <span id="protein_ErrorStatus" style="display: none" class="sr-only">(error)</span>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->

<!--                    Network-->
                    <div class="container center_label">
                        <label for="Network">Network:</label>
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
                    <!-- Layers -->
                    <div class="container center_label">
                        <label for="no_layers">No of Layers</label>
                    </div>
                    <div class="container center_input">
                        <div id="div_protein" class="form-group ">
                            <label class="control-label" style="display: none" id="protein_required" for="protein">Required</label>
                            <input type="text" class="form-control" aria-describedby="protein_ErrorStatus"
                                   name="protein" id="no_leyers" value="" placeholder="protein"/>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"
                                  id="protein_xMark" aria-hidden="true"></span>
                            <span id="protein_ErrorStatus" style="display: none" class="sr-only">(error)</span>

                        </div>
                    </div>
                    <!-- End -->

                    <!-- Neurons -->
                    <div class="container center_label">
                        <label for="no_neurons">No of Neurons</label>
                    </div>
                    <div class="container center_input">
                        <div id="div_protein" class="form-group ">
                            <label class="control-label" style="display: none" id="protein_required" for="protein">Required</label>
                            <input type="text" class="form-control" aria-describedby="protein_ErrorStatus"
                                   name="protein" id="no_neurons" value="" placeholder="protein"/>
                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"
                                  id="protein_xMark" aria-hidden="true"></span>
                            <span id="protein_ErrorStatus" style="display: none" class="sr-only">(error)</span>

                        </div>
                    </div>
                    <!-- End -->

                    <!-- Layers -->
                    <div class="container center_label">
                        <label for="no_layers">No of Layers</label>
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
                    <!-- End -->

                    <!-- Layers -->
                    <div class="container center_label">
                        <label for="no_layers">No of Layers</label>
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
                    <!-- End -->

                    <!-- Layers -->
                    <div class="container center_label">
                        <label for="no_layers">No of Layers</label>
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
                    <!-- End -->

                    <!-- Layers -->
                    <div class="container center_label">
                        <label for="no_layers">No of Layers</label>
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
                    <!-- End -->

                    <!-- Layers -->
                    <div class="container center_label">
                        <label for="no_layers">No of Layers</label>
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
                    <!-- End -->
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


<!--    <section id="banner">-->
<!--        <div class="content">-->
<!--            <form id="myform">-->
<!--                <div class="row uniform 50%">-->
<!--                    <header class="major 12u$">-->
<!--                        <h2>Build Your Own Network</h2>-->
<!--                    </header>-->
<!--                    <div class="container center_label">-->
<!--                        <label for="protein">Enter the amino acids of proteins:</label>-->
<!--                    </div>-->
<!--                    <div class="container center_input">-->
<!--                        <div id="div_protein" class="form-group ">-->
<!--                            <label class="control-label" style="display: none" id="protein_required" for="protein">Required</label>-->
<!--                            <input type="text" class="form-control" aria-describedby="protein_ErrorStatus"-->
<!--                                   name="protein" id="protein" value="" placeholder="protein"/>-->
<!--                            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"-->
<!--                                  id="protein_xMark" aria-hidden="true"></span>-->
<!--                            <span id="protein_ErrorStatus" style="display: none" class="sr-only">(error)</span>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="container center_label">-->
<!--                        <label for="Network">Choose Network:</label>-->
<!--                    </div>-->
<!--                    <div class="container center_input">-->
<!--                        <div class="form-group">-->
<!--                            <div class="select-wrapper">-->
<!--                                <select name="category" id="category">-->
<!--                                    --><?php //$i = 0;
//                                    while ($i < count($ResultModel)) { ?>
<!--                                        <option value="">--><?php //echo $ResultModel[$i]['title']; ?><!--</option>-->
<!--                                        --><?php //$i++;
//                                    } ?>
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="container center_label">-->
<!--                        <label for="Testing file">Choose a testing file:</label>-->
<!--                    </div>-->
<!--                    <div class="container center_input">-->
<!--                        <div class="form-group">-->
<!--                            <input type="file" name="testingUpload" id="testingUpload">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="12u$">-->
<!--                        <ul class="actions">-->
<!--                            <li><input type="reset" id="reset1" value="Reset"/></li>-->
<!--                            <li><a href="#banner" id="results" class="button ">Get Results</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </section>-->



<!---->
<!--<form class="form-horizontal">-->
<!--    <fieldset>-->
<!--        <!--    BOOTSTRAP FORM-->
<!--        <!-- Form Name -->
<!--        <legend>Form Name</legend>-->
<!---->
<!--        <!-- Select Basic -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="network">Network</label>-->
<!--            <div class="col-md-4">-->
<!--                <select id="network" name="network" class="form-control">-->
<!--                    <option value="1">BRNN</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Select Basic -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="no_layers">No. of Layers</label>-->
<!--            <div class="col-md-4">-->
<!--                <select id="no_layers" name="no_layers" class="form-control">-->
<!--                    <option value="1">1</option>-->
<!--                    <option value="2">2</option>-->
<!--                    <option value="3">3</option>-->
<!--                    <option value="4">4</option>-->
<!--                    <option value="5">5</option>-->
<!--                    <option value="6">6</option>-->
<!--                    <option value="7">7</option>-->
<!--                    <option value="8">8</option>-->
<!--                    <option value="9">9</option>-->
<!--                    <option value="10">10</option>-->
<!--                    <option value="11">11</option>-->
<!--                    <option value="12">12</option>-->
<!--                    <option value="13">13</option>-->
<!--                    <option value="14">14</option>-->
<!--                    <option value="15">15</option>-->
<!--                    <option value="16">16</option>-->
<!--                    <option value="17">17</option>-->
<!--                    <option value="18">18</option>-->
<!--                    <option value="19">19</option>-->
<!--                    <option value="20">20</option>-->
<!--                    <option value="21">21</option>-->
<!--                    <option value="22">22</option>-->
<!--                    <option value="23">23</option>-->
<!--                    <option value="24">24</option>-->
<!--                    <option value="25">25</option>-->
<!--                    <option value="26">26</option>-->
<!--                    <option value="27">27</option>-->
<!--                    <option value="28">28</option>-->
<!--                    <option value="29">29</option>-->
<!--                    <option value="30">30</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="no_neurons">No. of Neurons</label>-->
<!--            <div class="col-md-4">-->
<!--                <input id="no_neurons" name="no_neurons" placeholder="60"-->
<!--                       class="form-control input-md" required="" type="text">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="prev_layers">Previous Layers</label>-->
<!--            <div class="col-md-4">-->
<!--                <input id="prev_layers" name="prev_layers" placeholder="1, 3"-->
<!--                       class="form-control input-md" required="" type="text">-->
<!--                <span class="help-block">Seperate with comma</span>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="next_layer">Next Layers</label>-->
<!--            <div class="col-md-4">-->
<!--                <input id="next_layer" name="next_layer" placeholder="2, 5"-->
<!--                       class="form-control input-md" required="" type="text">-->
<!--                <span class="help-block">Seperate with comma</span>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Select Basic -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="layer_type">Layer Type</label>-->
<!--            <div class="col-md-4">-->
<!--                <select id="layer_type" name="layer_type" class="form-control">-->
<!--                    <option value="1">Input</option>-->
<!--                    <option value="2">Hidden</option>-->
<!--                    <option value="3">Context</option>-->
<!--                    <option value="4">Output</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Select Basic -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="error_function">Error Function</label>-->
<!--            <div class="col-md-4">-->
<!--                <select id="error_function" name="error_function" class="form-control">-->
<!--                    <option value="1">Gaussian</option>-->
<!--                    <option value="2">Ln</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Select Basic -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="activation_function">Activation-->
<!--                Function</label>-->
<!--            <div class="col-md-4">-->
<!--                <select id="activation_function" name="activation_function" class="form-control">-->
<!--                    <option value="1">Sigmoid</option>-->
<!--                    <option value="2">ReLU</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="learning_rate">Learning Rate</label>-->
<!--            <div class="col-md-2">-->
<!--                <input id="learning_rate" name="learning_rate" placeholder="0.1"-->
<!--                       class="form-control input-md" required="" type="text">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="momentum">Momentum</label>-->
<!--            <div class="col-md-2">-->
<!--                <input id="momentum" name="momentum" placeholder="0.1" class="form-control input-md"-->
<!--                       required="" type="text">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="delay_unit">Delay Unit</label>-->
<!--            <div class="col-md-2">-->
<!--                <input id="delay_unit" name="delay_unit" placeholder="1"-->
<!--                       class="form-control input-md" required="" type="text">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Select Basic -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="unknown_flag">Flag</label>-->
<!--            <div class="col-md-4">-->
<!--                <select id="unknown_flag" name="unknown_flag" class="form-control">-->
<!--                    <option value="1">Center</option>-->
<!--                    <option value="2">Backward</option>-->
<!--                    <option value="3">Forward</option>-->
<!--                    <option value="4">Output</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- Text input-->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="iterations">Max Iterations</label>-->
<!--            <div class="col-md-2">-->
<!--                <input id="iterations" name="iterations" placeholder="100"-->
<!--                       class="form-control input-md" required="" type="text">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- File Button -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="training_file">Training File</label>-->
<!--            <div class="col-md-4">-->
<!--                <input id="training_file" name="training_file" class="input-file" type="file">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!-- File Button -->
<!--        <div class="form-group">-->
<!--            <label class="col-md-4 control-label" for="testing_file">Testing File</label>-->
<!--            <div class="col-md-4">-->
<!--                <input id="testing_file" name="testing_file" class="input-file" type="file">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </fieldset>-->
<!--</form>-->



