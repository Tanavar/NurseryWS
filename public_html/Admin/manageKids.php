<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************
 
 $userID = $_SESSION['user'];
 include_once('../../dbConfig.php');

 include('libs/db.php');
 include('libs/childClass.php');
 
$childClass = new childClass();
$parentUserID = $_GET['id'];
$childClass -> getData($parentUserID);

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
	$('[id^=child]').on('click',function() { 
		var parent = $(this).attr('id');
		$('#body' + parent).slideToggle();
	})

	$('[id^=parent]').on('click',function() { 
		var parent = $(this).attr('id');
		$('#body' + parent).slideToggle();
	})

});
</script>
</head>
<body>
<div class='header'> <p class='headerText'>Marsh Lane Nursery</p></div>
<div class ='content' id='content'>  
<button name='users' onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
<button name='users' onclick="window.location.href='manageUsers.php';">Back Manage Users</button>
<button name='users' onclick="window.location.href='addChild.php?parentId=<? echo $parentUserID ?>';">Add New Child</button>



	<?
	
	if(isset($childClass -> rows))
	{
	
	foreach ($childClass -> rows as $value)
    {
        $ChildID =  $value[0];  
        $ChildParentID =  $value[1];
        $ChildParentUserID =  $value[2];
        $ChildFirstname =  $value[3];
        $ChildSurname = $value[4];
        $ChildDateOfBirth = $value[5];
        $ChildGender = $value[6];
        $ChildStartDate = $value[7];
        $ChildAllocatedRoom = $value[8];
        $ChildAllergies = $value[9];
        $ChildNote = $value[10];
        
        if($ChildGender == "Male")
        {
            echo "<div class ='childMaleHeading' id='child$ChildID'>";
        }
        else
        {
            echo "<div class ='childFemaleHeading' id='child$ChildID'>";
        }
        echo '+ ' .$ChildFirstname . ' ' .  $ChildSurname
        
        ?>
        <span class="TTbuttons">
            <input value="View Timesheets" type="button">
            <input value="Fill Timesheet" type="button" onclick="window.location.href='TTSelectPage.php?pid=<? echo $parentUserID; ?>&cid=<? echo $ChildID; ?>'; event.stopPropagation();"></span></div>
                <?
                
                        if($ChildGender == "Male")
        {
            echo "<div class ='childMaleSubHeading' id='bodychild$ChildID'>";
        }
        else
        {
            echo "<div class ='childFemaleSubHeading' id='bodychild$ChildID'>";
        }
        
                echo "
                
	<form method='POST' action='updateChild.php?id=$parentUserID'>
	<table>
		<tr><td width='100px'>Forename</td><td><input type='text' id='forename' name='forename' value = '$ChildFirstname'\></td></tr>
		<tr><td width='100px'>Surname</td><td><input type='text' id='surname' name='surname' value = '$ChildSurname'\></td></tr>
		<tr><td>Date of birth</td><td><input type='date' id='birthdate' name='dateofbirth' value='{$ChildDateOfBirth}'></td></tr>
		<tr><td>Gender</td><td><select name='gender' id='gender'>
			<option value=''>Please Select</option>";
			
			if($ChildGender == "Male")
			{
			echo "<option value='Male' selected>Male</option>
			<option value='Female'>Female</option>";
			}
			else if($ChildGender == "Female")
			{
			echo "<option value='Male'>Male</option>
			<option value='Female' selected>Female</option>";
			}

			
		echo "</select></td></tr><tr><td>Start Date</td><td><input type='date' id='startdate' name='startdate' value = '{$ChildStartDate}'></td></tr>
		<tr><td>Allocated Room</td><td><input type='text' id='room' name='allocatedroom' value='{$ChildAllocatedRoom}'></td></tr>
		<tr><td>Allergies</td><td><textarea name='allergies' id='allergies'>{$ChildAllergies}</textarea></td>
		<tr><td>Relevant notes</td><td><textarea name='relevantnotes' id='relevantnotes'>{$ChildNote}</textarea></td></tr>
		<tr><td><input type='hidden' name='childId' id='childId' value='{$ChildID}'> <input value='Save' type='Submit' name='action' id='action'></td></tr>
	</table>
	</form></div>";

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