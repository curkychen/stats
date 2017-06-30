<?php
include '../get/inc/db.php';
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$postdata = file_get_contents("php://input");
$delete = json_decode($postdata, true);




$position = $delete['upid'];
//echo $position;
$delete_room_query = "DELETE FROM user_position WHERE up_id = " . $position;
//echo $delete_room_query;
$delete_room_result = pg_query($connect, $delete_room_query);

?>