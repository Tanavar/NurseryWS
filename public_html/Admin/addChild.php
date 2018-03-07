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
    
                     $result = $dbCon->query("SELECT ParentID FROM ParentDetails WHERE UserID = '{$_GET['parentId']}'");
                 
                  $row = $result->fetch_assoc(); 
                $parentID = $row["ParentID"];
                
            $dbCon->query("INSERT INTO ChildDetails (ParentID) 
             VALUES ({$parentID})");
             

         header("Location: manageKids.php?id={$_GET['parentId']}");
    


//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>