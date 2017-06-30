<?php
include 'inc/db.php';
$postdata = file_get_contents("php://input");
$add_room = json_decode($postdata, true);

$roomNumber = $add_room['number'];
$building = $add_room['building'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$add_room_query = "INSERT INTO room (room_number, building_id) VALUES ('" . $roomNumber . "', " . $building . ")";
$add_room_result = pg_query($connect, $add_room_query);

?>