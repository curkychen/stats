<?php
include 'inc/db.php';
$postdata = file_get_contents("php://input");
$add_key = json_decode($postdata, true);

$keyNumber = $add_key['number'];
$keyRoom = $add_key['rooms'];
$keyBuilding = $add_key['building'];
$amount = $add_key['amount'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$add_keys_query = "INSERT INTO keys (key_ident_str) VALUES ('" . $keyNumber . "')";
$add_keys_result = pg_query($connect, $add_keys_query);

# add keyRoom need room_id and key_id 

# once keyRoom is updated, able to get building_id/building depending on room 
# key_id --> keyRoom: key_id -> room_id --> room: room_id -> building_id --> building: building 



$get_keys_query = "SELECT * FROM keys WHERE key_ident_str = '" . $keyNumber . "'";
$get_keys_result = pg_query($connect, $get_keys_query);
if(pg_num_rows($get_keys_result)>0){
	while($row = pg_fetch_assoc($get_keys_result)){
		$keyId = $row['key_id'];
	}
}

$update_room_query = "INSERT INTO room (building_id, key_id, room_number) 
					VALUES (" . $keyBuilding . ", " . $keyId . ", '" . $keyRoom . "')";
$update_room_result = pg_query($connect, $update_room_query);

for($i = 0; $i < $amount; $i++){
	$add_admin_key_query = "INSERT INTO person_keys (person_id, key_id, deposit_paid, deposit_date)
							VALUES (1, " . $keyId . ", 0, NULL)";
	$add_admin_key_result = pg_query($connect, $add_admin_key_query);
}
?>