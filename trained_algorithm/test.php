<?php

exec('./dokimi 2>&1', $output);
//print ($output[0]);
$message="";

foreach ($output as &$line) {
    //$message .= "\r\n";
    $message .= "$line<br />";
    //wordwrap($message, "\n");
    //nl2br("$message\n");
}

echo $message
//echo nl2br("$message\ndasd");


//$output = exec('./dokimi');
//echo $output
?>
