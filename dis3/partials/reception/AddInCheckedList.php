<?php
/**
 * Created by PhpStorm.
 * User: general
 * Date: 6/21/17
 * Time: 11:24 AM
 */
include('../get/inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$name = pg_escape_string($_POST['name']);

//$query="DELETE FROM images WHERE \"fileName\" LIKE '" . $name . "'";

//$query="UPDATE images SET active='1' WHERE \"fileName\" LIKE '" . $name . "'";

$query="UPDATE images SET active='1' WHERE \"fileName\" LIKE '$name'";

$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));

echo $query;

?>