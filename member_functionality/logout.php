<?php
/**
 * User: ppavli02
 * Date: July - August 2016
 * Comment: n case of logout we destroy all the SESSION's variables.
 */

session_start();
session_unset();
session_destroy();
header("location:../index.php");