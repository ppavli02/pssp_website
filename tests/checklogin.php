<?php
     /*
        We receive the information from the login form and
        if we can match a member from the database with the 
        email and the password, we then start a session with 
        these information, else we flash.
    */
    session_start();
    
    require("../../phpsqlajax_dbinfo.php");   

    $connection=mysqli_connect ($host, $username, $password,$database) or die("Error " . mysqli_error($connection));
                               
    $email = $_POST['email-input'];
    $user_password = $_POST['password-input'];

    $email = stripslashes($email);
    $email = mysql_real_escape_string($email);
    $user_password = stripslashes($user_password);
    $user_password = mysql_real_escape_string($user_password);
    $user_password = md5($user_password);

    if($stmt = $connection->prepare("SELECT * from $database.MEMBER WHERE email=? AND password=?")){
        $stmt->bind_param("ss", $email,$user_password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row= $result->fetch_array(MYSQLI_ASSOC);
        
    
        $mple=0;
        $prasino=0;
        $poios=-1;
        
        $mple=$row['pre74'];
        $prasino=$row['post74'];
        $poios=$row['id'];

        if($connection->affected_rows==1){
            $_SESSION["email"]=$email;
            $_SESSION["password"]=$user_password;
            $_SESSION["logged_in"]=1;
            $_SESSION["errorLogin"]=null;
            $_SESSION["pre74"]=$mple;
            $_SESSION["post74"]=$prasino;
            $_SESSION["member"]=$poios;
            header("location:login_success.php");
        }else{
            $_SESSION["errorLogin"]=1;
            header("location:../../index.php");
        }
        ob_end_flush();
        
        $stmt->close();
    }

?>