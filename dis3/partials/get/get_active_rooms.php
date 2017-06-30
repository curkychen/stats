<?php 
	include ('inc/db.php');
	$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
	
	$i = 0;
	$query_get_room="SELECT * FROM room WHERE active = 1";
	
	$room_result=pg_query($connect, $query_get_room) or die("Error in query:$query_get_room.".pg_last_error($connect));
	if(pg_num_rows($room_result)>0){
		while($row=pg_fetch_assoc($room_result)){
			$room_id=$row['room_id'];
			$room_number=$row['room_number'];
			$data[$i][]=$room_id;
			$data[$i][]=$room_number;
			$i++;
		}
	}
	
	$temproom=" [ ";
	if(isset($data)){
		foreach($data as $line){
			$temproom .= '{
				"roomID": "' . $line[0] . '",
				"roomNumber": "' . $line[1] . '" },';
		}
		$room=substr($temproom, 0, -1);
		$room.= " ]";
		echo $room;
	}
?>