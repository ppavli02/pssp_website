<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
    echo "<script>flag=true;</script>";
} else {
    echo "<script>flag=false;</script>";
}
include "setSelectionLists.php";
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
    <script src="js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie8.css"/><![endif]-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--Bootstrap-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--Sweetalert-->
    <script src="_/libs/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="_/libs/sweetalert/sweetalert.css">
    <!-- My code -->
    <script src="trained_functionality/runAlgorithm.js"></script>
    <script src="trained_functionality/handleIndex.js"></script>
    <script src="trained_functionality/handleModals.js"></script>

</head>
<body class="landing">

<div id="page-wrapper">
    <!-- Header -->
    <header id="header">
        <nav id="nav">
            <ul>

                <li><?php
                    if (isset($_SESSION['isLoggedIn'])) {
                        echo $_SESSION['user_email'];
                    }
                    ?></li>
                <li><a href="#four">Help</a></li>
                <li id="create_network"></li>
                <li id="login_btn"></li>
            </ul>
        </nav>
    </header>

    <!-- Banner -->
    <section id="banner">
        <div class="content">
            <form id="myform" enctype="multipart/form-data">
<!--            <form id="myform">-->
                <div class="row uniform 50%">
                    <header class="major 12u$">
                        <h2>Run a trained Neural Network</h2>
                    </header>

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
                        <label for="Testing file">Upload your FASTA & MSA files:</label>
                    </div>
                    <!-- Fasta -->
                    <div class="container center_input">
                        <div class="form-group">
                            <input type="file" required="" name="run_fasta_testing" id="run_fasta_testing" class="input-file">
                        </div>
                    </div>
                    <!-- MSA -->
                    <div class="container center_input">
                        <div class="form-group">
                            <input type="file" required="" name="run_msa_testing" id="run_msa_testing" class="input-file">
                        </div>
                    </div>

                    <div class="12u$">
                        <ul class="actions">
                            <li><a id="defineContact" class="button ">Run</a></li>
                        </ul>
                    </div>

                </div>
            </form>
        </div>
        <a href="#two" class="goto-next scrolly">Next</a>
    </section>

    <!--Retrieve Data-->
    <section id="two" class="spotlight style1 bottom">
        <div class="content">
            <div class="container">
                <form>
                    <div class="row uniform 50%">
                        <header class="major 12u$">
                            <h2>Retrieve Results from Network</h2>
                        </header>
                        <div class="container center_label">
                            <label for="div_placeCode">Place your code to get your results:</label>
                        </div>
                        <div class="container center_input">
                            <div id="div_placeCode" class="form-group">
                                <label class="control-label" style="display: none" id="placeCode_required"
                                       for="getResults">Required</label>
                                <input type="text" name="getResults" aria-describedby="placeCode_ErrorStatus"
                                       id="getResults" value="" placeholder="code"/>
                                <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"
                                      id="placeCode_xMark" aria-hidden="true"></span>
                                <span id="placeCode_ErrorStatus" style="display: none" class="sr-only">(error)</span>
                            </div>
                        </div>
                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="reset" id="reset2" value="Reset"/></li>
                                <li><a href="#two" id="submit" class="button">Get Results</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <a href="#four" class="goto-next scrolly">Next</a>
    </section>

    <!-- Information -->
    <section id="four" class="wrapper style2 special fade-up">
        <div class="container">
            <header class="major">
                <h2>What this project is all about</h2>
                <p>Powered by UCY.</p>
            </header>
            <div class="box alt">
                <p>Coming soon.</p>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_contact_us">
                    Contact Us
                </button>
            </div>
        </div>
    </section>

</div>

<!-- Modal Email/GenerateCode -->
<div class="modal fade" id="modal_email_generateCode" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" id="modalA_content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">How can we deliver you the results?</h4>
            </div>
            <div class="modal-body" id="modalA_body">
                <p>You can choose to give either your email or take a unique code to retrieve the results later on.</p>
                <div class="row">
                    <label for="email" id="emailLabel">Email:</label>
                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="Email"
                           required/>
                </div>
                <div class="row">
                    <label>Or</label>
                </div>
                <div class="6u 12u$(medium)" id="generateCode">
                    <input type="checkbox" id="code" name="code" checked>
                    <label for="code">Generate Code</label>
                </div>
                <label class="control-label" style="display: none;width:100%" id="choose">* You must choose email or
                    generate code</label>

            </div>
            <div class="modal-footer">
                <button type="button" id="modelSubmit" class="btn btn-default">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal contact Us -->
<div class="modal fade" id="modal_contact_us" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" id="modal_content_contact_us">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contact Us </h4>
            </div>
            <div class="modal-body" id="modal_body_contact_us">
                <form method="post" action="#">
                    <div class="row uniform 50%">
                        <div class="6u 12u$(xsmall)">
                            <input type="text" name="name" id="name" value="" placeholder="Name">
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="email" name="email" id="email_contact_us" value="" placeholder="Email">
                        </div>
                        <div class="12u$">
                            <textarea name="message" id="message" placeholder="Enter your message" rows="6"></textarea>
                        </div>
                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="submit" value="Send Message" class="special"></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="js/core_js/jquery.scrolly.min.js"></script>
<script src="js/core_js/jquery.dropotron.min.js"></script>
<script src="js/core_js/jquery.scrollex.min.js"></script>
<script src="js/core_js/skel.min.js"></script>
<script src="js/core_js/util.js"></script>
<!--[if lte IE 8]>
<script src="js/ie/respond.min.js"></script><![endif]-->
<script src="js/core_js/main.js"></script>


<!-- Footer -->
<footer id="footer">

    <ul class="icons">
        <li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
        <li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>
        <li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
        <li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
    </ul>
    <ul class="copyright">
        <li>&copy; UCY. All rights reserved.</li>
        <li>Implementation: ppavli02 - Panayiotis Pavlides <a href="https://github.com/ppavli02"
                                                              class="icon alt fa-github"><span
                    class="label">GitHub</span></a></li>
        <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
    </ul>
    <itooter>

</body>
</html>