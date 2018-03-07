<?
$title = 'Marsh Lane Day Nursery LTD - News Letters';
include_once('templates/headingScroll.php');
?>

<div class="content">
<h1>Our news letters</h1>

	<?
	$files = glob('docs/*.{pdf}', GLOB_BRACE);
foreach($files as $file) {
    $path_parts = pathinfo($file);
    $fileName = $path_parts['filename'];
    echo "<div style='display:inline'>
    <a href='$file' target='tt'> $fileName</a>
    </div>";
    echo "<br>";
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