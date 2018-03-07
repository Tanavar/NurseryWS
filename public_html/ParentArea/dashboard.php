<?php
 session_start(); 

 if (isset($_SESSION['user'])) {
 //***********************************************************************

if($_SESSION['userlevel'] == 'Admin' || $_SESSION['userlevel'] == 'Super')
 {
    header("Location: https://marshlanenursery.co.uk/Admin/dashboard.php");
 }
 
 $userID = $_SESSION['user'];
 include_once('../../dbConfig.php');
 include('libs/parentClass.php');
 include('libs/childClass.php');
 
$parentClass =new parentClass();
$childClass = new childClass();

$parentClass -> getData($userID);
$childClass -> getData($userID);
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
<div class='header'> <p class='headerText'>Marsh Lane Nursery</p><br/> <p class='subHeaderText'> 64 Marsh Ln, Yeovil BA21 3BX</p></div>
<div class ='parentHeading' id='parent11'>+ <? echo $parentClass->Firstname . " " . $parentClass->Surname ; ?>

        <span class="TTbuttons">
            <input value="Logout" type="button" onclick="window.location.href='logout.php';event.stopPropagation();"></span></div>
            
</div>
<div class ='parentSubHeading' id='bodyparent11'>
	<form>
	<table>
		<tr><td width='120px'>Firstname</td><td><input type='text' id='firstname' value='<? echo $parentClass->Firstname; ?> '\></td></tr>
				<tr><td width='120px'>Surname</td><td><input type='text' id='surname' value='<? echo $parentClass->Surname; ?>'\></td></tr>
		<tr><td>Email</td><td><input type='text' id='email' value='<? echo $parentClass->Email; ?>'/></td></tr>
		<tr><td>Address</td><td><textarea name='address' form='' id='address'><? echo $parentClass->Address; ?></textarea></td></tr>
		<tr><td>New Password</td><td><input type='text' id='password'\></td></tr>
		<tr><td>Confirm Password</td><td><input type='text' id='confirmpassword'\></td></tr>
		<tr><td><input type='hidden' name='parentId' id='parentId' value='<? echo $userID; ?>'> <input value='Save' type='Submit' name='action' id='action'></td></tr>
	</table>
	</form></div>

		<?
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
            <input value="Fill Timesheet" type="button" onclick="window.location.href='TTpage.php'; event.stopPropagation();"></span></div>
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
                
	<form>
	<table>
		<tr><td width='100px'>Forename</td><td><input type='text' id='forename' value = '$ChildFirstname'\></td></tr>
		<tr><td width='100px'>Surname</td><td><input type='text' id='surname' value = '$ChildSurname'\></td></tr>
		<tr><td>Date of birth</td><td><input type='date' id='birthdate'></td></tr>
		<tr><td>Gender</td><td><select name='gender' id='gender' value = ''>
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

			
		echo "</select></td></tr><tr><td>Start Date</td><td><input type='date' id='startdate'></td></tr>
		<tr><td>Allocated Room</td><td><input type='text' id='room' readonly></td></tr>
		<tr><td>Allergies</td><td><textarea name='allergies' form='' id='allergies'></textarea></td>
		<tr><td>Relevant notes</td><td><textarea name='relevantnotes' form='' id='relevantnotes'></textarea></td></tr><tr><td><input type='hidden' name='childId' id='childId' value='{$ChildID}'> <input value='Save' type='Submit' name='action' id='action'></td></tr>
	</table>
	</form></div>";

    }
	?>
</body>
</html>
   

 <?php
//**************************************************************************
 } else {
    header("Location: https://marshlanenursery.co.uk/ParentArea/");
 }
?>