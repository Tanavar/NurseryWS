<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************

 include_once('../../dbConfig.php');
 include ("libs/db.php");
  include ("libs/childClass.php");
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
    
         
            if($_POST['action'] == 'Save')
             {
                $child = new childClass();
                $child -> firstname = $_POST['forename'];
                $child -> surname =  $_POST['surname'];
                $child -> dateOfBirth =  $_POST['dateofbirth'];
                $child -> gender =  $_POST['gender'];
                $child -> startDate =  $_POST['startdate'];
                $child -> allocatedRoom =  $_POST['allocatedroom'];
                $child -> allergies = $_POST['allergies'];
                $child -> notes = $_POST['relevantnotes'];
                $child -> childID = $_POST['childId'];
                
                $child -> saveData();
                $parentID = $_GET['id'];
                header("Location: https://marshlanenursery.co.uk/Admin/manageKids.php?id={$parentID}");
             }
             
             
         

     
    


//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>