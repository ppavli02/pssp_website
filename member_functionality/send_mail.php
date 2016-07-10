<?php
#Ignore the closing window
//ignore_user_abort(true);
//set_time_limit(0);

#Send Mail
require_once('../mailing_funtionality/class.phpmailer.php');
require_once('../mailing_funtionality/class.smtp.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "andreasfrangou3@gmail.com";
$mail->Password = "katiaapanotou";

$mail->SetFrom('andreasfrangou3@gmail.com', 'Verify Member');
$mail->Subject = "A new member needs approval!";
$mail->MsgHTML($message);
$mail->AddAddress($email, $name);

if($mail->Send()) {
    echo "Message sent!";
} else {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

try {
    // sql to delete a record

    $sql = "DELETE FROM `PENDING_RESULTS` WHERE `id`='$email'";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record deleted successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>