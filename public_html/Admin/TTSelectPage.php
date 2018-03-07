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
 include('libs/tt.php');
 
$pid = $_GET["pid"];
$cid = $_GET["cid"];
$ttid = $_GET["tid"];

 $timeTable = new TTClass;

 $timeTable -> getNonLockedData(); 
 ?>
 
<html>
<head>
<title>Marsh Lane Nursery - Admin area</title>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet">
<style>
    .tblDates {
      width: 100%;
      margin-right: 15px;
      text-align: center;
    }
        
    .dvDates
    {
        background-color: #ffcc99;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>

$(document).ready(function() {
$(":checkbox").change(function() { 
$("#total_sessions").val($('[id^="chk"]:checkbox:checked').length);
})
});
 </script>
</head>
<body>
<div class='header'> <p class='headerText'>Admin Area: User - <? echo $adminClass->adminName; ?></p><button name='logout' onclick="window.location.href='logout.php';">Logout</button></div>
<div class='content'>
    <button name='users' onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
<button name='users' onclick="window.location.href='manageUsers.php';">Back Manage Users</button>
<button name='users' onclick="window.location.href='manageKids.php?id=Jamiec';">Back to Kids</button>
<br/><br/>
<h3>Please select a timesheet to fill</h1>
<? 
	if(isset($timeTable -> rows))
	{

    	foreach ($timeTable -> rows as $value)
        {
            $periodID = $value[0];
            $periodName = $value[1];
            $periodStart = $value[2];
            $periodEnd = $value[3];
            $locked = $value[4];
            
            echo "<a href='TTpage.php?pid=$pid&cid=$cid&tid=$periodID'>$periodName</a><br/>";
        }
        
	}

?>
</div>
</body>
</html>
   

 <?php
//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>