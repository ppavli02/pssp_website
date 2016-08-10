<?php
/**
 * User: ppavli02
 * Date: July - August 2016
 * Comment: This php file executes the python script, which checks the uploaded files.
 *
 * Returns: "1" if files are ok.
 *          $message - message about the errors.
 */
$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

$token = $json_decoded->{'md5'};

$all_ok_flag = false;
$exception_flag = false;

exec('/usr/local/bin/python /webserver/model_trained/check_run.py ' . $token . ' 2>&1', $output);

if (is_array($output) && sizeof($output) == 1) {
    foreach ($output as $line) {
        if ($line == "[]") {
            $all_ok_flag = true;
            break;
        } else {
            $line = str_replace("[", "", $line);
            $line = str_replace("]", "", $line);
            $line = str_replace("'", "", $line);
            $err_array = (explode(",", $line));
            foreach ($err_array as $temp_error) {
                switch ($temp_error) {
                    case "1":
                        if (!$exception_flag)
                            $message .= "One or more files in the zip file don't have the '.hssp' extension." . "</br>";
                        break;
                    case "2":
                        if (!$exception_flag)
                            $message .= "One or more lines of the msa files don't sum up to the expected range of values." . "</br>";
                        break;
                    case "3":
                        if (!$exception_flag)
                            $message .= "There are invalid references in the FASTA file to the zip folder." . "</br>";
                        break;
                    case "4":
                        if (!$exception_flag) {
                            $message .= "The secondary structure in the FASTA file does not contain only the characters 'H',
                            'C', 'E', '!'. " . "</br>";
                            $message .= "(case insensitive)" . "</br>";
                        }
                        break;
                    case "5":
                        $message = "We do not welcome harmful documents. Thank you, and don't do it again." . "</br>";
                        $exception_flag = true;
                        break;
                    default:
                        if (!$exception_flag)
                            $message .= "Undefined error." . "</br>";
                        break;
                }
            }
        }
    }

} else {
    $message .= "Not the expected output from the test script" . "</br>";
}


if ($all_ok_flag) {
    echo "1";
} else {
    echo $message;
}
