<?php
$dbhost							= "localhost";
$dbuser							= "reception";
$dbpass							= "UMdx8H92nfAawtFh";
$dbname							= "receptionImages";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database");
mysqli_select_db($conn,$dbname);
?>