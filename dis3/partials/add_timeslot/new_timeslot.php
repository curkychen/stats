<?php
include '../get/inc/db.php';

$logmessage = "\nstarting\n";

$postdata = file_get_contents("php://input");
$time = json_decode($postdata, true);

$user_id = $time['name'];
$course_id = $time['course'];
$start = $time['startTime'];
$end = $time['endTime'];
$room = $time['room'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$room_search_query = "SELECT * FROM room_availability WHERE $room = room_id";
$logmessage .= " $room_search_query\n";
$room_search_result=pg_query($connect, $room_search_query) or die("Error in query:$room_search_query.".pg_last_error($connect));
if(pg_num_rows($room_search_result)>0){
	$i=0;
	while($row=pg_fetch_assoc($room_search_result)){
		$data[$i][] = $row['room_id'];
		$data[$i][] = $row['active_since']; 
		$data[$i][] = $row['active_until'];
		$i++;
	}
}

// Commented out below code because it was causing a constant error message and duplicate time slots to be added each time this file was called
// $arr = array();
// foreach($data as $roomtest) {
// 	if($roomtest[0] == $room) {
// 		$newStart = substr($start, 0, 10);
// 		$newEnd = substr($end, 0, 10);
// 		$logmessage .= " $newStart $roomtest[1] $roomtest[2]";
// 		if($newStart <= $roomtest[1] || $newStart >= $roomtest[2]){
// 			$logmessage .= " room unavailable\n";
// 			$arr = array('msg' => "", 'error' => 'Room unavailable');
// 			$jsn = json_encode($arr);
// 			print_r($jsn);	
// 		} else {
// 			$query = "INSERT INTO time_slots (timeslot_id, start_time, end_time, user_id, room, course_id) VALUES 
// 			(DEFAULT, '" . $start . "', '" . $end . "', '" . $user_id . "', '" . $room . "', '" . $course_id . "')";
// 			$result = pg_query($connect, $query); 
// 			$arr = array('msg' => "Timeslot Created Successfully!", 'error' => '');
// 			$jsn = json_encode($arr);
// 			print_r($jsn);
// 		}
// 	}
// }

$query = "INSERT INTO time_slots (timeslot_id, start_time, end_time, user_id, room, course_id) VALUES 
	(DEFAULT, '" . $start . "', '" . $end . "', '" . $user_id . "', '" . $room . "', '" . $course_id . "')";
$result = pg_query($connect, $query); 
if ($result) {
	$arr = array('msg' => "Timeslot Created Successfully!", 'error' => '');
	$jsn = json_decode($arr);
	print_r($jsn);
} else {
	$arr = array('msg' => "", 'error' => 'Room unavailable');
	$jsn = json_decode($arr);
	print_r($jsn);	
}

?>