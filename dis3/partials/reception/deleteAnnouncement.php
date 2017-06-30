<?php
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost","reception","UMdx8H92nfAawtFh","receptionImages") or die(mysqli_error($conn));

$name = $_POST['name'];

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


$deleteImage = "DELETE FROM news where text ='$name'";


mysqli_query($conn, $deleteImage);


?>

