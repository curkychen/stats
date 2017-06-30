<?php
include '../get/inc/db.php';
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$postdata = file_get_contents("php://input");
$add_rel = json_decode($postdata, true);

$url = $_SERVER['REQUEST_URI'];
error_log($url, 3, "./php.log");
//$user = substr($url, 46);
$user = substr(strrchr(rtrim($url, '/'), '/'), 1);

$relationship = $add_rel['rId'];

$start = substr($add_rel['relStart'], 0, -14);

$end = substr($add_rel['relEnd'], 0, -14);
//echo $position;
$workedWith = $add_rel['relName'];

$add_rel_query = "INSERT INTO user_relationships (user_id_1, rel_type_id, rel_start, rel_end, user_id_2) VALUES (" . $user . ", " . $relationship .  ", '" . $start . "', '" . $end . "', " . $workedWith . ")";
//echo $add_rel_query;
$add_rel_result = pg_query($connect, $add_rel_query) or die ("Error in Query:$add_rel_query.".pg_last_error($connect));

?>
