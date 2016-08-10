<?php
/**
 * Returns user's email.
 */

session_start();
if (isset($_SESSION['isLoggedIn'])){
    echo $_SESSION['user_email'];
}else{
    echo "";
}
