<?php
 session_start(); 

echo $_SESSION["user"];

 if (isset($_SESSION['user'])) {
 ?>
 <br>
   logged in HTML and code here
 <?php

 } else {
   ?>
   <br>
   Not logged in HTML and code here
   <?php
 }
?>