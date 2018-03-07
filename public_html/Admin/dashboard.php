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
 include('libs/adminClass.php');

 $adminClass = new adminClass();
 $adminClass -> getData($userID);

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
<div class='header'> <p class='headerText'>Admin Area: User - <? echo $adminClass->adminName; ?></p><button name='logout' onclick="window.location.href='logout.php';">Logout</button></div>
<div class='content'>
    <button name='users' onclick="window.location.href='manageUsers.php';">Manage Users</button>
    <button name='gallery' onclick="window.location.href='https://marshlanenursery.co.uk/Admin/manageGallery.php';">Manage Gallery</button>
        <button name='timesheetparam' onclick="window.location.href='https://marshlanenursery.co.uk/Admin/tsParams.php';">Timesheet Setup</button>
                <button name='timesheetparam' onclick="window.location.href='https://marshlanenursery.co.uk/Admin/docUpload.php';">Upload Newsletter</button>
</div>
</body>
</html>
   

 <?php
//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>