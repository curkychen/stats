<html>
<head></head>
<body>
File Upload
<?php
$id=$_GET['id'];
$type=$_GET['type'];
?>
	<form action="uploadfile.php?res=<?php echo $id . '&type=' . $type; ?>" method="post" enctype="multipart/form-data">
		<input type="file" name="file" /><br>
		<input type="hidden" name="res" value="<?php echo $id; ?>" /><br>
		<input type="submit" value="Submit" />
	</form>
</body
</html>
