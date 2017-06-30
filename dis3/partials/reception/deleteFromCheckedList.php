<?php
/**
 * Created by PhpStorm.
 * User: general
 * Date: 6/21/17
 * Time: 10:49 AM
 */
include('../get/inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$name = $_POST['name'];

//$query="DELETE FROM images WHERE \"fileName\" LIKE '" . $name . "'";
//$name = "2016-11-22-12-55-09_hyun.png";
$query="UPDATE images SET active='0' WHERE \"fileName\" LIKE '" . $name . "'";
$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));

echo $query;
echo gettype($name);

?>
