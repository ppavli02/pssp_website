<?php

$filename = '/webserver/trainingFiles/a12.txt';

if (file_exists($filename)) {
    echo "The file $filename exists";
} else {
    echo "The file $filename does not exist";
}
?>
