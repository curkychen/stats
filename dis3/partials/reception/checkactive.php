<?php
include('../get/inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$name = $_POST['name'];
$checkstatus = $_POST['checkstatus'];

// //getting number of rows to get what position to put in if occupied
// $getRows = "SELECT fileName FROM images WHERE active='1'";
// $retval = mysqli_query($conn,$getRows);
// $numRows = mysqli_num_rows($retval);
// echo($numRows);
// //get the position the file is at 
// $getPos = "SELECT position FROM images WHERE fileName = '$name'";
// $result = mysqli_query($conn,$getPos);
// $retval = mysqli_fetch_array($result, MYSQL_ASSOC);
// $pos = $retval['position'];
// echo $pos;

// $checkpos = "SELECT fileName FROM images WHERE position = '$pos' AND active = '1'";
// $retval = mysqli_query($conn,$checkpos);
// $checkPosition = mysqli_num_rows($retval);

//is the position occupied?


$getLastPos = "SELECT position FROM images where active = '1' ORDER BY position DESC limit 1";
$result = pg_query($conn,$getLastPos);
$retval = pg_fetch_array($result, pg_fetch_assoc());
$checkPosition = $retval['position']+1;


echo($checkPosition);
if ($checkPosition >0 && $checkstatus==1){
	$update = "UPDATE images SET active = '$checkstatus', position = '$checkPosition' WHERE fileName = '$name'";
}
else{
$update = "UPDATE images SET active = '$checkstatus' WHERE fileName = '$name'";

}
pg_query($conn, $update);


?>

