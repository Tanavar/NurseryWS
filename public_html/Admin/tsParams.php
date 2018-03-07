<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************
 
 $userID = $_SESSION['user'];
 include_once('../../dbConfig.php');


 include('libs/db.php');
 include_once('libs/tt.php');
 
 $timeTable = new TTClass;

if($_POST["submit"] == "Save")
{
$periodName = $_POST["tsName"];
$startDate = $_POST["tsStartDate"];
$endDate = $_POST["tsEndDate"];
if($periodName <> "" && $startDate <> "" && $endDate <> "")
{
$timeTable -> storePeriod($periodName, $startDate, $endDate);
}
else
{
    $error = "Not all Fields have been populated";
}
//$timeTable -> storeData();
}

 $timeTable -> getData(); 
 ?>
 
<html>
<head>
<title>Marsh Lane Nursery - Parent's area</title>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$( "[type=checkbox]" ).on('change',function() { 
		var id = $(this).val();
		var chkValue = $(this).is(':checked') ;
	    var oauthWindow = window.open("https://marshlanenursery.co.uk/Admin/updateTS.php?id=" + id + "&val=" + chkValue, "myWindow", 'width=800,height=600');
    oauthWindow.close();
	})


});
</script>
</head>
<body>
<div class='header'> <p class='headerText'>Marsh Lane Nursery</p></div>
<div class ='content' id='content'>  
<button name='users' onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
<div style="width: 127px;display: table-cell;"> <label>Period Name: </label><br>
    <label>Start Date: </label><br>
    <label>End Date: </label><br> </div>
<div style="width: 200px;display: table-cell;">
    
<form method="post" action="tsParams.php">
 <input name="tsName" placeholder="Period Name" size="50" maxlength="50" type="text">
    <input type="date" name="tsStartDate"><br>
    <input type="date" name="tsEndDate"><br>
    <input type="submit" name="submit" value="Save"/>
</form>
<? echo "<p><font color='red'>$error</font></p>"; ?></div>
<table class="ttTable"><tr><td>Period Name</td><td>Period Start Date</td><td>Period End Date</td><td>Is Locked</td></tr>
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
            
            echo "<tr><td>$periodName</td><td>$periodStart</td><td>$periodEnd</td><td> <input type='checkbox' name='periodLocked' value='$periodID' ";
            if($locked == 1)
            {
            echo "checked";
            }
            echo "></td></tr>";
        }
        
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