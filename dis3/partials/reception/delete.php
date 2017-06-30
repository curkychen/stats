<?php
include('../get/inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$name = $_POST['name'];

$query="DELETE FROM images WHERE \"fileName\" LIKE '" . $name . "'";
$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));
echo $query;
$path = '/var/www/html/dis/uploads/reception/';
unlink($path.$name);


?>

