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
 $tt = new TTClass;

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
      font-weight: bold;
    }
        
    .dvDates
    {
        background-color: #FF7F2A;
        color: #ffffff;
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

<form action="saveTT.php?pid=<?echo $pid;?>&cid=<?echo $cid;?>&tid=<?echo $ttid;?>"  method="POST">
<table border="1" class="tblDates"><tr>
    <?
    
    $tt -> getDates($ttid);
    
$begin = $tt -> dates[0];
$end = $tt -> dates[1];

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);
 
echo '<table border="1" class="tblDates"><tr>';
foreach ( $period as $dt )
{
  if($dt->format("l") != 'Saturday' && $dt->format("l") != 'Sunday')
  {
      echo '<td width="20%"><div class="dvDates">', $dt->format("D"), '</br>', $dt->format("d/m"), '</div>';
    echo '<label><input type="checkbox" name="chk', $dt->format("y/m/d"), '_AM" id="chk', $dt->format("d_m_Y"), '_AM"> AM</label>';
    echo '</br><label><input type="checkbox" id="chk', $dt->format("d_m_Y"), '_PM" name="chk', $dt->format("y/m/d"), '_PM"> PM</label>', '</td>';
  }
  
  if($dt->format("l") == 'Friday')
  {
      echo '</tr><tr>';
  }
}
echo '</table>';
echo '<table border=0><tr>
<td>Total Sessions Selected </td><td> <input type="text" id="total_sessions" readonly="true"></td></tr></table><input type="submit" value="submit">';
?>
</form>
</div>
</body>
</html>
   

 <?php
//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>