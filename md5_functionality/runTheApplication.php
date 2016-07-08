<?php
#Ignore the closing window
ignore_user_abort(true);
set_time_limit(0);

$md5 = $_GET['q'];

require("../MySqlConnect.php");

#Execute the algorithm
exec('../mail_system/dokimi 2>&1', $output);

foreach ($output as &$line) {
//    $result.= "$line<br/>";
    $result.= $line."\n";
}

try {
    // sql to delete a record
    $sql = "UPDATE `webApp`.`PENDING_RESULTS` SET `results`='$result' WHERE `id`='$md5'";
    // use exec() because no results are returned
    $conn->exec($sql);
//    echo "Record deleted successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>