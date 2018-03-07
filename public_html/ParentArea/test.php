<?php

include_once('../../dbConfig.php');


if ($result = $mysqli->query("SELECT * FROM UserMaster")) {

    /* determine number of rows result set */
    $row_cnt = $result->num_rows;
    
    echo $row_cnt;
        $result->close();
}

/* close connection */
$mysqli->close();
?>