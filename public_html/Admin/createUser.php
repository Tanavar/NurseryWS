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
    
     $date = date('Y-m-d H:i:s');
     
     if($result = $dbCon->query("SELECT * FROM UserMaster WHERE UserID = '" . $_POST['userId'] . "'")) {
         
         $row_cnt = $result->num_rows;
         if($row_cnt == 0)
         {
             $dbCon->query("INSERT INTO UserMaster 
             SELECT '{$_POST['userId']}', '{$_POST['userType']}', '{$date}', '{$_SESSION['user']}'");
             
            $dbCon->query("INSERT INTO UserPassword 
             SELECT '{$_POST['userId']}', '{$_POST['password']}'");

            if($_POST['userLevel'] == 'Parent')
            {
                
                  $dbCon->query("INSERT INTO ParentDetails (UserId, FirstName, Surname, Email, Address)
                  SELECT '{$_POST['userId']}', '{$_POST['firstname']}','{$_POST['surname']}','{$_POST['email']}','{$_POST['address']}'");
                  
                 $result = $dbCon->query("SELECT ParentID FROM ParentDetails WHERE UserID = '{$_POST['userId']}'");
                 
                  $row = $result->fetch_assoc(); 
                $parentID = $row["ParentID"];

                $dbCon->query("INSERT INTO ChildDetails (ParentID, FirstName, Surname, Gender, AllocatedRoom, Allergies, Notes)
                SELECT '{$parentID}','','','','','',''");
                
                  
            }
            else
            {
                 $dbCon->query("INSERT INTO AdminDetails SELECT '{$_POST['userId']}', '{$_POST['firstname']}','{$_POST['surname']}'");
            }
           
            header("Location: manageUsers.php");
         }
         else
         {
             echo 'User name already Exists, Please press the back button on your brower to return to the Admin page';
         }

     }
    
//    $result = $dbCon->query("UPDATE UserMaster SET UserType ='Supper' WHERE //UserID = 'JamieC'");


//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>