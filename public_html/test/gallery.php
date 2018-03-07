<?
$title = 'Marsh Lane Day Nursery LTD - Gallery';
include_once('templates/headingScroll.php');
?>

<div class="content">
    <h1>Gallery</h1>
	<?
	$files = glob('galleryPhotos/*.{jpg,png,gif}', GLOB_BRACE);
foreach($files as $file) {
    $path_parts = pathinfo($file);
    $fileName = $path_parts['filename'];
    echo "<img src='$file' class='galleryPhotos' alt='$fileName'/>";
}
	?>
</div>
<div class="footer">
</div>
<?
include_once('templates/footer.php');
?>

</body>
</html>