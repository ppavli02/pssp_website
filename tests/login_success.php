<?php
    /*
        If the login was a success, we proceed to the homepage
        by indicating that the user is logged in, else we simply 
        return to the homepage.
    */
    session_start();
    
    if(!isset($_SESSION["logged_in"])){
        header("location:../../index.php");
    }else{
        $user=$_SESSION['email'];
        $isLoggedin = $_SESSION['logged_in'];
        header("location:../../index.php?result=$isLoggedin&user=$user");
    }
?>
