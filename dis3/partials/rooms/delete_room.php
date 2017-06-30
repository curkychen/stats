<?php
include 'inc/db.php';
$postdata = file_get_contents("php://input");
$delete_room = json_decode($postdata, true);

$roomID = $delete_room['roomID'];
//echo $roomID;
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$delete_room_query = "DELETE FROM room WHERE room_id = " . $roomID;
$delete_room_result = pg_query($connect, $delete_room_query);

?>