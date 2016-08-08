<?php
/**
 * User: ppavli02
 * Date: July - August 2016
 * Comment: This php file is called from checkFiles.php if everything was ok.
 * It is responsible to execute the script which contains the network's code.
 * Then, it inserts the data into the database, executes the executable, send
 * an email to the user, informing him about the results and finally saves the
 * results into the /webserver/resultsFiles/ folder.
 *
 * Returns: "1" if mail is not sent. Otherwise, the code returns nothing.
 */

ignore_user_abort(true);
set_time_limit(0);

session_start();
$token = $_SESSION["token"];
$user_email = $_SESSION["user_email"];
$file_message="";

$parameterFile_loc = "/webserver/parameterFiles/parameter_".$token;

require("../MySqlConnect.php");

$start_timestamp = time();
try {
    $sql = "INSERT INTO `LOGFILE` (`token`, `user_id`, `start_timestamp`, `end_timestamp`) VALUES
        ('$token', '$user_email', '$start_timestamp', '')";
    $conn->exec($sql);
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    exit;
}

#Execute the algorithm
exec('/webserver/model/build/network '.$parameterFile_loc.' 2>&1', $output);

$end_timestamp = time();
try{
    $stmt = $conn->prepare("UPDATE `webApp`.`LOGFILE` SET `end_timestamp`='$end_timestamp' WHERE `token`='$token';");
    $stmt->execute();
}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

foreach ($output as &$line) {
    $message.= "$line<br/>";
    $file_message .= "$line\n";
}

# Send Mail
require_once('class.phpmailer.php');
require_once('class.smtp.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "pssp.ucy.webapp@gmail.com";
$mail->Password = "webapp2016";

$mail->SetFrom('pssp.ucy.webapp@gmail.com', 'Web App');
$mail->Subject = "Your PSSP Results";
$mail->MsgHTML($message);
$mail->AddAddress($user_email, $user_email);

if(!$mail->Send()) {
    echo "Email not sent.";
    exit;
}

$conn = null;

# Create Results File.
$result_path="/webserver/resultFiles/results_".$token.".txt";
if (!($resultFile = fopen($result_path, "w"))){
    echo "Could not open $result_path!";
    exit;
}
$txt = $file_message;
fwrite($resultFile, $txt);
fclose($resultFile);