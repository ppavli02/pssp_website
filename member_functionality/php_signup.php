<?php

$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

$firstname = $json_decoded->{'user_firstname'};
$lastname = $json_decoded->{'user_lastname'};
$user_username = $json_decoded->{'user_username'};
$user_password = $json_decoded->{'user_password'};
$user_repeat_password = $json_decoded->{'user_repeat_password'};
$user_reason = $json_decoded->{'user_reason'};
$timesVisited = 0;
$accountType = 'UNKNOWN';


#Check if password is the same.
if (strcmp("$user_repeat_password", "$user_password") != 0) {
    echo "2";
    return;
}

#encode password
$user_password = md5($user_password);

#create verification code
$verification = md5(uniqid(rand(),1));

require("../MySqlConnect.php");

try {
    $sql = "INSERT INTO `USER` (`verification`, `firstname`, `lastname`, `email`, `password`, `timesVisited`, `accountType`)
        VALUES ('$verification', '$firstname', '$lastname', '$user_username', '$user_password', '$timesVisited', '$accountType')";
    $conn->exec($sql);
//    echo "New record created successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
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
$mail->Username = "andreasfrangou3@gmail.com";
$mail->Password = "katiaapanotou";

#Fill in email gaps
foreach ($output as &$line) {
    $message .= "$line<br />";
}

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
$message = "http://".$_SERVER['HTTP_HOST']."$cwd/verify.php?q=$verification";
$message .= "<br />";
$message .= "========================================";
$message .= "<br />";

$mail->SetFrom('andreasfrangou3@gmail.com', 'Verify Member');
$mail->Subject = "A new member needs approval!";
$mail->MsgHTML($message);
$mail->AddAddress("panayiotis.pavlides@gmail.com", "Panayiotis Pavlides");

if ($mail->Send()) {
//    echo "Message sent!";
} else {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

