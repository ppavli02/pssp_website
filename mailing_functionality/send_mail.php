<?php
#Ignore the closing window
ignore_user_abort(true);
set_time_limit(0);

#Get arguements
$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

$name=$json_decoded->{'name_trained'};
$name = stripslashes($name);
$name = mysql_real_escape_string($name);

$email=$json_decoded->{'email_trained'};
$email = stripslashes($email);
$email = mysql_real_escape_string($email);

//echo 1;

//REGISTER THE PROCESS INTO THE DATABASE
require("../MySqlConnect.php");
$results = "";
try {
    $sql = "INSERT INTO `PENDING_RESULTS` (`id`, `results`)
        VALUES ('$email', '$results')";
    $conn->exec($sql);
    }
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    }


#Execute the algorithm
exec('./dokimi 2>&1', $output);
$message="";

foreach ($output as &$line) {
    $message .= "$line<br />";
}

#Send Mail
require_once('class.phpmailer.php');
require_once('class.smtp.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "andreasfrangou3@gmail.com";
$mail->Password = "katiaapanotou";

$mail->SetFrom('andreasfrangou3@gmail.com', 'Web App');
$mail->Subject = "Your PSSP Results";
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