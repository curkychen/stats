<?php

include 'inc/db.php';
$url = $_SERVER['REQUEST_URI'];
// keyNum is 6 character string/id AFTER the last "/" in the URL 
//$keyIdIndexStart = strrpos($url, "/") + 1;
//$keyNum = substr($url, $keyIdIndexStart);

//replace the above code with the following line:
$keyNum = substr(strrchr(rtrim($url, '/'), '/'), 1);

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$keyId = '';

if($keyId != 'undefined'){
	$key_data="SELECT * FROM key_room
		JOIN room ON room.room_id = key_room.room_id
		JOIN keys ON keys.key_id = key_room.key_id
		JOIN building ON building.building_id = room.building_id
		WHERE keys.key_ident_str = '" . $keyNum . "' ";
	$key_result=pg_query($connect, $key_data) or die ("Error in query:$key_data.".pg_last_error($connect));

	if(pg_num_rows($key_result)>0){
		while($row=pg_fetch_array($key_result)){
			$key_number=$row['key_ident_str'];
			$building = $row['building_name'];
			$key_id = $row['key_id'];
		}
	}
		
	
	$temp = '{ 
	"keyNumber": "' . $key_number . '", 
	"building": "' . $building . '", ';
	
	$available_query = "SELECT COUNT(*) AS total FROM person_keys WHERE user_id = 1 AND key_id = " . $key_id;
	$available_result = pg_query($connect, $available_query);
	$row_in_stock = pg_fetch_assoc($available_result);
	
	$temp .= '"inStock": "' . $row_in_stock[total] . '",';
			
	$rsq = "SELECT * FROM key_room
			JOIN room ON room.room_id = key_room.room_id
			JOIN keys ON keys.key_id = key_room.key_id
			WHERE keys.key_id = " . $key_id;
	$rsr = pg_query($connect, $rsq) or die ("Error in Query:$rsq.".pg_last_error($connect));

	$i = 0;
	if(pg_num_rows($rsr)>0){		
		while($roomdata=pg_fetch_array($rsr)){
			//echo 'help';
			$roomNumber = $roomdata['room_number'];
			$rd[$i][] = $roomNumber;
			$i++;		
		}
	}

	if(isset($rd)){
		$temp .= '"roomList": [';
		foreach($rd as $line){
			$temp .= '{"roomNumber": "' . $line[0] . '"},';
		}
		$newTemp = substr($temp, 0, -1);
		$newTemp .= ' ], ';
	}
	else{
		$newTemp = $temp;
	}
	

	$ko_data = "SELECT * FROM person_keys
		JOIN keys ON keys.key_id = person_keys.key_id		
		JOIN users ON users.id = person_keys.user_id
		WHERE keys.key_ident_str = '" . $keyNum . "'
		AND user_id <> 1";
	$ko_result=pg_query($connect, $ko_data) or die ("Error in query:$ko_data.".pg_last_error($connect));
	$q=0;

	if(pg_num_rows($ko_result)>0){
		while($new=pg_fetch_array($ko_result)){
			$id = $new['user_id'];
			$first= $new['first_name'];
			$last = $new['last_name'];
			$owner[$q][]=$first;
			$owner[$q][]=$last;
			$owner[$q][]=$id;
			$q++;
		}
	}			
	//print_r($owner);
	if(isset($owner)){
		$newTemp .= '"keyOwners":[ ';
		foreach($owner as $obj){
			$newTemp.='{
			"name": "' . $obj[1] . ', ' . $obj[0] . '",
			"id": "' . $obj[2] . '"},';
		}
		$key=substr($newTemp, 0, -1);
		$key.="]  } ";
		echo $key;
	}
	else{
		$newTemp .= '"keyOwners":[{
				"name": "None checked out",
				"id": "-1"}]}';
		echo $newTemp;
	}
}

	
?>
