<?php
Session_start(); 


$fileName = '../' . $_POST['fileName'];
//echo $fileName;
//echo realPath($fileName) . ' l';
echo unlink($fileName);

?>