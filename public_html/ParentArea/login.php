<?php
session_start();

include_once('../../dbConfig.php');
$userid = $_POST['userid'];
$password = $_POST['password'];



if ($result = $mysqli->query("SELECT UM.UserID, UM.UserType From UserMaster UM 
    INNER JOIN UserPassword UP ON UM.UserID = UP.UserID WHERE UM.UserId = '$userid' AND UP.Password = '$password'")) {

    /* determine number of rows result set */
    $row_cnt = $result->num_rows;
    
    echo $row_cnt;
        $result->close();
        
        $row = $result[0];
}

/* close connection */
$mysqli->close();

if($row_cnt == 1)
{

$_SESSION["user"]= $userid;
$_SESSION["userlevel"]= $userlevel;
}

  
?>