<?php
	include ('../get/inc/db.php');
	if(isset($_GET['day'])){
			$today=strftime($_GET['day']);
			}
		else{
			$today=strftime(time());
		}

	$first=strtotime('last sunday', $today);
	$hour_start="08:00:00";
	$beginning=date("Y-m-d " . $hour_start, $first);
		
	$last=strtotime('friday this week', $today);
	$hour_end="20:00:00";
	$end=date("Y-m-d " . $hour_end, $last);
	
	$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
		
	$data="SELECT * FROM users
	JOIN time_slots ON users.id = time_slots.user_id 
	JOIN class_list ON time_slots.course_id = class_list.id 
	JOIN room ON room.room_id = time_slots.room";

// Need to figure out how to get this to bind to the id in the divs in the calendar to change view
	if(isset($_POST['class_number'])){
		$data .= " AND course_id = " . $_POST['course_number'];
	}	
	$result=pg_query($connect, $data) or die ("Error in query:$data.".pg_last_error($connect));
	$i=0;

	if(pg_num_rows($result)>0){
		while($row=pg_fetch_assoc($result)) {
			$start= substr($row['start_time'], 0, -3);
			$end= substr($row['end_time'], 0, -3);
			$andrew_id=$row['andrew_id'];
			$color=$row['color_value'];
			$ta_id=$row['user_id'];
			$room_number=$row['room_number'];
			$class_number=$row['course_number'];
			$slot[$i][]= $start;
			$slot[$i][]=$end;
			$slot[$i][]=$andrew_id;
			$slot[$i][]=$color;
			$slot[$i][]=$ta_id;
			$slot[$i][]=$room_number;
			$slot[$i][]=$class_number;
			$i++;
		}
	} 


$temp = "[";
if(isset($slot)){
	foreach($slot as $div){
		$temp .= ' {
		"type": "info",
		"id": "' . $div[6] . '",
		"title": "' . $div[2] . ' - ' . $div[5] . ' - ' . $div[6] . ' (' . strftime("%I:%M %p", strtotime($div[0])) . '-' . strftime("%I:%M %p", strtotime($div[1])) . ') ' . '",
		"startsAt": "' . $div[0] . '",
		"endsAt": "' . $div[1] . '", 
		"url": "sp.stat.cmu.edu/dis/index.html#/people/users/user.php/' . $div[4] . '"},';
	}
	$ts = substr($temp, 0, -1);
	$ts .= " ]";
	echo $ts;
}
?>