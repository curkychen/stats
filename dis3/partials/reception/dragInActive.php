<?php
/**
 * Created by PhpStorm.
 * User: general
 * Date: 6/22/17
 * Time: 1:03 PM
 */
include ('../get/inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$name = pg_escape_string($_POST['name']);
$position = $_POST['position'];
$query="UPDATE images SET position=$position WHERE \"fileName\" LIKE '$name'";
$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));
echo $query;
?>