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

<script>
$(document).ready(function() {
	$('a').on('click',function() { 

	$fileName = $(this).parent().find('img:first').attr('src');
	//***************************************
	
	var dataObject = {"fileName": $fileName};
		$.ajax({
			type: "POST",
			url: "libs/managePhotoClass.php",
			data: dataObject,
			cache: false,
			success: function(result){
			}
			});
	$(this).parent().hide();
	//***************************************
	});


});
</script>

</head>
<body>
<div class='header'> <p class='headerText'>Admin Area: Manage Photos</p><button name='logout'  onclick="window.location.href='logout.php';">Logout</button></div>
<div class='content'>
        <button name='users' onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <form enctype="multipart/form-data" action="uploadImage.php" method="post">
        Photos need to be 800 x 600 or less<br>
    <input name="fileToUpload" id="fileToUpload" type="file" /><br/>

    <input type="submit" id="submit" name="submit" value="Upload"/>
    </form>
	<?
	$files = glob('../test/galleryPhotos/*.{jpg,png,gif}', GLOB_BRACE);
foreach($files as $file) {
    $path_parts = pathinfo($file);
    $fileName = $path_parts['filename'];
    echo "<div style='display:inline'><img src='$file' class='galleryPhotos' alt='$fileName'/>";
    echo " <a>Delete</a></div>";
    echo "<br>";
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