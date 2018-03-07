<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************

 include_once('../../dbConfig.php');
 include ("libs/db.php");
  include ("libs/tt.php");
     $db = new db();
     $timeTable = new TTClass;
 if($_SESSION['userlevel'] != 'Admin' && $_SESSION['userlevel'] != 'Super' )
 {
         header("Location: https://marshlanenursery.co.uk/ParentArea/dashboard.php");
 }
 
 
  $dbCon = new mysqli("localhost", $db->userName, $db->passWord, $db->dataBase);
        /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
  
  $id = $_GET["id"];  
  if($_GET["val"] == "true")
  {
     $val = 1;
  }
  else
  {
    $val = 0;
  }
  $query = "UPDATE TimeTablePeriods SET Locked = '$val' WHERE TimetableID = '$id'";
  
$timeTable -> runScript($query);


//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>