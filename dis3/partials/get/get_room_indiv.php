<?php
include 'inc/db.php';
$url = $_SERVER['REQUEST_URI'];
// roomID is 1-3 character string/id AFTER the last "/" in the URL 
$roomIdIndexStart = strrpos($url, "/") + 1;
$roomId = substr($url, $roomIdIndexStart);
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$room_indiv_query = "SELECT * FROM room
JOIN key_room ON key_room.room_id = room.room_id
JOIN building ON building.building_id = room.building_id
JOIN keys ON keys.key_id = key_room.key_id
WHERE room.room_id = " . $roomId;
$room_result = pg_query($connect, $room_indiv_query) or die ("Error in query:$room_indiv_query.".pg_last_error($connect));


if(pg_num_rows($room_result)>0){
	while($row = pg_fetch_assoc($room_result)){
		$room_number = $row['room_number'];
		$building = $row['building_name'];
		$key = $row['key_ident_str'];
	}
}

$temp = '{
		"roomNumber": "' . $room_number . '",
		"building": "' . $building . '",
		"keyNumber": "' . $key . '",
		"keyHolders": [';
				
$keyHolderQuery = "SELECT * FROM room
		JOIN key_room ON key_room.room_id = room.room_id
		JOIN building ON building.building_id = room.building_id
		JOIN keys ON keys.key_id = key_room.key_id
		JOIN person_keys ON person_keys.key_id = keys.key_id
		JOIN users ON users.id = person_keys.user_id
		WHERE users.id <> 1 
		AND room.room_id = " . $roomId;
$keyHolderResult = pg_query($connect, $keyHolderQuery) or die ("Error in query:$keyHolderQuery.".pg_last_error($connect));

$i = 0;
if(pg_num_rows($keyHolderResult)>0){
	while($new = pg_fetch_assoc($keyHolderResult)){
		$firstName = $new['first_name'];
		$lastName = $new['last_name'];
		
		$db[$i][]= $firstName;
		$db[$i][] = $lastName;
		$i++;
	}
}

if(isset($db)){
	foreach($db as $line){
		$temp .= '{"name": "' . $line[1] . ', ' . $line[0] . '"},';
	}
	$room = substr($temp, 0, -1);
	$room .= ']}';
	echo $room;
}
else{
	$temp .= '{"name": "No Current Owners!"}]}';
	echo $temp;
}

?>