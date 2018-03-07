<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************

 if($_SESSION['userlevel'] != 'Admin' && $_SESSION['userlevel'] != 'Super' )
 {
         header("Location: https://marshlanenursery.co.uk/ParentArea/dashboard.php");
 }
 
 $userID = $_SESSION['user'];
 include_once('../../dbConfig.php');
 include ("libs/db.php");
 include('libs/manageUsersClass.php');

 $userClass = new manageUserClass();
 $userClass -> getParentData();
 $userClass -> getAdminUsers();
 ?>
 
<html>
<head>
<title>Marsh Lane Nursery - Admin area</title>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<div class='header'> <p class='headerText'>Admin Area: Manage Users</p><button name='logout'  onclick="window.location.href='logout.php';">Logout</button></div>
<div class='content'>
    <button name='users' onclick="window.location.href='dashboard.php';">Back to Dashboard</button>    <br>
    
    <table>
        <tr><td><b>UserName</b></td>
        <td><b>Firstname</b></td>
        <td><b>Surname</b></td>
        <td><b>Email Address</b></td>
        <td><b>Address</b></td>
        <td><b>New Password</b></td>
        <td><b>User Level</b></td>
        <td><b>Actions</b></td>
        </tr>
        <form name="createUser" id="createUser" method="POST" action="createUser.php" >
            
        <tr><td><input type="text" name="userId" id="userId"/></td>
        <td><input type="text" name="firstname" id="firstname"/></td>
        <td><input type="text" name="surname" id="surname"/></td>
        <td><input type="text" name="email" id="email"/></td>
        <td><input type="text" name="address" id="address"/></td>
        <td><input type="text" name="password" id="password"/></td>
        <td>    <select name="userLevel" id="userLevel">
        <option>Parent</option>
        <option>Admin</option>
        </select></td>
        <td><input type="submit" value="Add User"></td>
        </tr></form>

    <?
	foreach ($userClass -> rows as $value)
    {
        $UserID =  $value[0];  
        $FirstName =  $value[1];
        $Surname =  $value[2];
        $Email =  $value[3];
        $Address = $value[4];
        $userType = $value[5];

        echo '<tr><form method="POST" action="updateUser.php" id="'. $UserID .'">' .
        '<td><input type="textbox" name="userId" id="userId" value="' .
        $UserID . '" readonly></td>';
        
        echo  '<td><input type="textbox" name="firstName" id="firstName" value="' .
        $FirstName . '"></td>';
        echo  '<td><input type="textbox" name="surName" id="surName" value="' .
        $Surname . '"></td>';
        echo  '<td><input type="textbox" name="email" id="email" value="' .
        $Email . '"></td>';

        echo  '<td><input type="textbox" name="address" id="address" value="' .
        $Address . '"></td>';
        echo  '<td><input type="password" name="pass" id="pass"></td>';
        echo "<td>    <select name='userLevel' id='userLevel' disabled>";
        
        if($userType =="Parent")
        {
        echo "<option selected>Parent</option>
        <option>Admin</option>";
        }
        else
        {
        echo "<option >Parent</option>
        <option selected>Admin</option>";  
        }
        
        echo"</select></td>";
         echo '<td>';
         
         if($userType =="Parent")
         {
         echo '<input type="submit" name="action" value="View Children" />';
         }
         echo '<input type="submit" name="action" value="Update" />
<input type="submit" name="action" value="Delete" /></td>';
        echo '</form></tr>';
    }
 ?>
 
 </table>
</div>
</body>
</html>
   

 <?php
//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>