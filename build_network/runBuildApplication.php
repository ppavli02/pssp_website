<?php
ignore_user_abort(true);
set_time_limit(0);

session_start();
$token = $_SESSION["token"];
$user_email = $_SESSION["user_email"];

$parameterFile_loc = "/webserver/parameterFiles/parameter_".$token;
echo $parameterFile_loc;

require("../MySqlConnect.php");

$start_timestamp = time();
try {
    $sql = "INSERT INTO `LOGFILE` (`token`, `user_id`, `start_timestamp`, `end_timestamp`) VALUES
        ('$token', '$user_email', '$start_timestamp', '')";
    $conn->exec($sql);
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

#Execute the algorithm
exec('/webserver/model/build/network '.$parameterFile_loc.' 2>&1', $output);

$end_timestamp = time();
try{
    $stmt = $conn->prepare("UPDATE `webApp`.`LOGFILE` SET `end_timestamp`='$end_timestamp' WHERE `token`='$token';");
    $stmt->execute();
}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

foreach ($output as &$line) {
    $message.= "$line<br/>";
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
$mail->AddAddress($user_email, $user_email);

if(!$mail->Send()) {
    echo "1";
}

$conn = null;