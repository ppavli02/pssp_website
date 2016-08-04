<?php
ignore_user_abort(true);
set_time_limit(0);

session_start();
$token = $_SESSION["token"];
$user_email = $_SESSION["user_email"];

$send_email_flag = true;

exec('/usr/local/bin/python /webserver/checkFiles/check.py ' . $token . ' 2>&1', $output);
$message = "Some errors have been encountered while testing the files you have uploaded." . "</br>";
$message .= "Please review those errors and try uploading the files again." . "</br>";
$message .= "You can use this code to retrieve your parameter file, and not build it again: " . "</br>";
$message .= $token . "</br>";
$message .= "--------------------------------------------------------------------------------------------------------------" . "</br>";


if (is_array($output) && sizeof($output) == 1) {
    foreach ($output as $line) {
        if ($line == "[]") {
            $send_email_flag = false;
            break;
        }
        $line = str_replace("[", "", $line);
        $line = str_replace("]", "", $line);
        $line = str_replace("'", "", $line);
        $err_array = (explode(",", $line));
        foreach ($err_array as $temp_error) {
            switch ($temp_error) {
                case "1":
                    $message .= "One or more files in the zip file don't have the '.hssp' extension." . "</br>";
                    break;
                case "2":
                    $message .= "One or more lines of the msa files don't sum up to the expected range of values." . "</br>";
                    break;
                case "3":
                    $message .= "There are invalid references in the FASTA file to the zip folder." . "</br>";
                    break;
                case "4":
                    $message .= "The secondary structure in the FASTA file does not contain only the characters 'H', 
                    'C', 'E', '!'. " . "</br>";
                    $message .= "(case insensitive)" . "</br>";
                    break;
                default:
                    $message .= "Undefined error." . "</br>";
                    break;

            }
        }
        //        $message .= "$line<br />";
    }

} else {
    $message .= "Undefined error." . "</br>";
    $message .= "Not the expected output from the test script" . "</br>";
}
$message .= "--------------------------------------------------------------------------------------------------------------" . "</br>";
$message .= "For further info, please review out help section." . "</br>";

//echo $message;
echo $user_email;


//Send Email
if ($send_email_flag) {
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


    $mail->SetFrom('andreasfrangou3@gmail.com', 'PSSP');
    $mail->Subject = "Errors with file uploading.";
    $mail->MsgHTML($message);
    $mail->AddAddress($user_email, $user_email);

    if ($mail->Send()) {
        echo "Message sent!";
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

