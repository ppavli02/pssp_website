<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Material Login Form</title>


    <link rel="stylesheet" href="../css/reset.css">

    <link rel='stylesheet prefetch'
          href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="../css/style.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!--        <script src="js/jquery-1.7.1.min.js"></script>-->

    <!--Sweetalert-->
    <script src="../_/libs/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../_/libs/sweetalert/sweetalert.css">
    <!-- My code -->
    <script src="logInAppearance.js"></script>
    <script src="handleRegistration.js"></script>
    <script src="handleLogIn.js"></script>


</head>

<body class="landing">


<div class="rerun"><a href="../index.php">Back Home</a></div>
<div class="container">
    <div class="card"></div>
    <div class="card">
        <h1 class="title">Login</h1>

        <!--Log In Form-->

        <form id="logIn_form">
            <div class="input-container">
                <input type="text" id="username_login" required="required"/>
                <label for="Username">Username</label>
                <div class="bar"></div>
            </div>
            <div class="input-container">
                <input type="password" id="password_login" required="required"/>
                <label for="Password">Password</label>
                <div class="bar"></div>
            </div>
            <div class="button-container">
                <button><span>Go</span></button>
            </div>
            <!--<div class="footer"><a href="#">Forgot your password?</a></div>-->
        </form>
    </div>
    <div class="card alt">
        <div class="toggle"></div>
        <h1 class="title">Register
            <div class="close"></div>
        </h1>

        <!--Sign Up Form-->

        <form id="signUp_form">
            <div class="input-container">
                <input type="text" id="user_firstname" required="required"/>
                <label for="Name">Name</label>
                <div class="bar"></div>
            </div>
            <div class="input-container">
                <input type="text" id="user_lastname" required="required"/>
                <label for="Surname">Surname</label>
                <div class="bar"></div>
            </div>
            <div class="input-container">
                <input type="text" id="user_username" required="required"/>
                <label for="Username">Username</label>
                <div class="bar"></div>
            </div>
            <div class="input-container">
                <input type="password" id="user_password" required="required"/>
                <label for="Password">Password</label>
                <div class="bar"></div>
            </div>
            <div class="input-container">
                <input type="password" id="user_repeat_password" required="required"/>
                <label for="Repeat Password">Repeat Password</label>
                <div class="bar"></div>
            </div>
            <div class="big-input-container">
                <input type="text" id="user_reason" required="required"/>
                <label for="Reason">Why you want to use this app?</label>
                <div class="bar"></div>
            </div>

            <div class="button-container">
                <button><span>Sign Up Now!</span></button>
            </div>
        </form>

    </div>


</div>
</body>
</html>
