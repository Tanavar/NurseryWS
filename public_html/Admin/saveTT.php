<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************

 include_once('../../dbConfig.php');
 include ("libs/db.php");
     $db = new db();
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
    
    $ParentID = $_GET["pid"];
    $ChildID = $_GET["cid"];
    $TimeTableID = $_GET["tid"];
    
              
     $dbCon->query("DELETE FROM ChildTimeTable WHERE ChildID = '$ChildID' AND TimeTableID = '$TimeTableID'");
             
    foreach($_POST as $name => $value) {

         $splitString = explode("_", $name);
      //   echo strtotime($splitString[0]);
      $date = str_replace("chk","",$splitString[0]);
 
        $dbCon->query("INSERT INTO ChildTimeTable (ChildID, TimeTableID, Date, Session) VALUES ('$ChildID', '$TimeTableID', '$date' , '$splitString[1]')");
    }

 header("Location: https://marshlanenursery.co.uk/Admin/TTpage.php?pid={$ParentID}&cid={$ChildID}&tid={$TimeTableID}");

//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>