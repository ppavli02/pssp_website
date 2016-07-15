<?php
    /*
        In case of logout we destroy all the SESSION's
        variables.
    */
    session_start();
    session_unset();
    session_destroy();
    header("location:../index.php");
?>
