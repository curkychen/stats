<?php
include '../get/inc/db.php';
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$postdata = file_get_contents("php://input");
$add_pos = json_decode($postdata, true);

$url = $_SERVER['REQUEST_URI'];
error_log($url, 3, "./php.log");
//$user = substr($url, 46);
$user = substr(strrchr(rtrim($url, '/'), '/'), 1);

$position = ", " . $add_pos['pId'];
$start = ", '" . substr($add_pos['startDate'], 0, -14) . "', ";

if ($add_pos['endDate'] == '') {
	$end = "NULL";
} else {
	$end =  "'" . substr($add_pos['endDate'], 0, -14) . "'";
}

$add_pos_query = "INSERT INTO user_position (user_id, position_id, start_date, end_date) VALUES (" . $user . $position . $start . $end . ")";
//echo $add_room_query;
$add_pos_result = pg_query($connect, $add_pos_query) or die ("Error in Query:$add_pos_query.".pg_last_error($connect));

?>
