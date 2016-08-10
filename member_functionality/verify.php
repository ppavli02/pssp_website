<?php
/**
 * User: ppavli02
 * Date: July - August 2016
 * Comment: This php file verifies the user who recently signed up to our
 * application. Then, informs the user by email that is now a confirmed user.
 */

$token = $_GET['q'];

require("../MySqlConnect.php");

#Update client's row in the DB.
try {
    $stmt = $conn->prepare("SELECT * FROM `USER` WHERE `verification`='$token'");
    $stmt->execute();

    if (!$stmt->rowCount()) {
        echo "No such member.";
        exit;
    }
    
    $row = $stmt->fetchAll();

    $user_firstname = $row[0]['firstname'];
    $user_email = $row[0]['email'];
    $user_accountType = $row[0]['accountType'];

    if ($user_accountType == 'ADV') {
        echo "This member has already been verified.";
        exit;
    } else {
        $stmt = $conn->prepare("UPDATE `USER` SET `accountType`='ADV' WHERE `verification`='$token'");
        $stmt->execute();
        echo "SUCCESS.<br />";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

$conn = null;

#Send him an email.
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
$message = "-------------------------------------------------------------<br />";
$message .= "We now welcome you to our webpage as an<br />";
$message .= "ADVANCED user.<br />";
$message .= "<br />";
$message .= "Log in here: ";
$message .= "<br />";
$message .= "-------------------------------------------------------------<br />";

$mail->SetFrom('pssp.ucy.webapp@gmail.com', 'PSSP');
$mail->Subject = "You have been approved!";
$mail->MsgHTML($message);
$mail->AddAddress($user_email, $user_firstname);

if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
