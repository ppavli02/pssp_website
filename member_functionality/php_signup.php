<?php
/**
 * User: ppavli02
 * Date: July - August 2016
 * Comment: Handles the sign up form. Creates an entry in the database.
 * Afterwards, it sends email to the admin asking for user verification.
 * Returns: An array of errors.
 */

//PLEASE DO NOT DELETE ANY COMMENTS.

$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

#Get arguements from JSON
$firstname = $json_decoded->{'user_firstname'};
$lastname = $json_decoded->{'user_lastname'};
$user_username = $json_decoded->{'user_username'};
$user_password = $json_decoded->{'user_password'};
$user_repeat_password = $json_decoded->{'user_repeat_password'};
$user_reason = $json_decoded->{'user_reason'};
$accountType = 'UNKNOWN';

#Strip strings
$firstname = strip_input($firstname);
$lastname = strip_input($lastname);
$user_username = strip_input($user_username);
$user_password = strip_input($user_password);
$user_repeat_password = strip_input($user_repeat_password);

$form_errors = array();

#Error 1: Invalid firstname
if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
    array_push($form_errors,"1");
}

#Error 2: Invalid lastname
if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
    array_push($form_errors,"2");
}

#Error 3: Password is not the same
if (strcmp("$user_repeat_password", "$user_password") != 0) {
    array_push($form_errors,"3");
}

#Error 4: Email has incorrect format
if (!filter_var($user_username, FILTER_VALIDATE_EMAIL)) {
    array_push($form_errors,"4");
}

if (!empty($form_errors)){
    echo json_encode($form_errors);
    exit;
}


#encode password
$user_password = md5($user_password);

#create verification code
$verification = md5(uniqid(rand(),1));

require("../MySqlConnect.php");

try {
    $sql = "INSERT INTO `USER` (`verification`, `firstname`, `lastname`, `email`, `password`, `accountType`)
        VALUES ('$verification', '$firstname', '$lastname', '$user_username', '$user_password', '$accountType')";
    $conn->exec($sql);
} catch (PDOException $e) {
    array_push($form_errors,"5");
    echo json_encode($form_errors);
    exit;
}

$conn = null;


#Send Mail
require_once('class.phpmailer.php');
require_once('class.smtp.php');

#Set email settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "pssp.ucy.webapp@gmail.com";
$mail->Password = "webapp2016";

#Fill in email gaps
$message = "Please review this request for membership.<br />";
$message .= "<br />";
$message .= "----------------------------------------";
$message .= "<br />";
$message .= "First Name: ".$firstname."<br />";
$message .= "Last Name: ".$lastname."<br />";
$message .= "Email: ".$user_username."<br />";
$message .= "Reason: ".$user_reason."<br />";
$message .= "<br />";
$message .= "<br />";
$message .= "========================================";
$message .= "<br />";
$message .= "Verify user:";
$message .= "<br />";
$cwd = substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],"/"));
$message .= "http://".$_SERVER['HTTP_HOST']."$cwd/verify.php?q=$verification";
$message .= "<br />";
$message .= "========================================";
$message .= "<br />";

$mail->SetFrom('pssp.ucy.webapp@gmail.com', 'Verify Member');
$mail->Subject = "A new member needs approval!";
$mail->MsgHTML($message);
$mail->AddAddress("pssp.ucy.webapp@gmail.com", "UCY");

if (!$mail->Send()) {
    array_push($form_errors, "6");
}

if (!empty($form_errors)){
    echo json_encode($form_errors);
    exit;
}

function strip_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
