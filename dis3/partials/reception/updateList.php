<?php 
include("connect.php");
$array	= $_POST['arrayorder'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
				

		$query = "UPDATE images SET position = " . $count . " WHERE imageID = " . $idval;

		echo $query;
		mysqli_query($conn, $query) or die('Error, insert query failed!!!!');
		$count ++;	
	}
	echo 'All saved! refresh the page to see the changes'.$count;
}
?>