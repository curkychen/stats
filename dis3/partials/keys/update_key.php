<?php
include 'inc/db.php';
$postdata = file_get_contents("php://input");
$update_key = json_decode($postdata, true);

$key = $update_key['key'];
$room = $update_key['room'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$update_key_query = "INSERT INTO key_room (room_id, key_id) VALUES (" . $room . ", " . $key . ")";
$update_key_result = pg_query($connect, $update_key_query) or die("Error in Query:" . pg_last_error($connect));


?>