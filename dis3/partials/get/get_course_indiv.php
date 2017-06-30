<?php

include 'inc/db.php';
$url = $_SERVER['REQUEST_URI'];
// course ID is a 1-3 digit integer AFTER the last "/" in the URL 
$courseIdIndexStart = strrpos($url, "/") + 1;
$courseId = substr($url, $courseIdIndexStart);
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$course_data="SELECT * FROM class_list WHERE id = " . $courseId;
$course_result=pg_query($connect, $course_data) or die ("Error in query:$course_data.".pg_last_error($connect));
$i=0;
//print_r($course_result);
if(pg_num_rows($course_result)>0){
	while($row=pg_fetch_array($course_result)){
		$id = $row['id'];
		$courseId=$row['course_number'];
		$courseName=$row['course_name'];
		$semester=$row['semester'];
		$start=$row['start_date'];
		$end=$row['end_date'];	
		$instructor_id=$row['instructor_id'];

		// get instructor name and email with instructor_id
		$instructor_data="SELECT first_name, last_name, email_address FROM users WHERE id = '" . $instructor_id . "'";
		$instructor_result=pg_query($connect, $instructor_data) or die ("Error in query:$instructor_data"/pg_last_error($connect));
		if(pg_num_rows($instructor_result)>0){
			while($ins_row=pg_fetch_array($instructor_result)) {
				$instructor_first=$ins_row['first_name'];
				$instructor_last=$ins_row['last_name'];
				$instructor_email=$ins_row['email_address'];
			}
		}
		$data[$i][]=$id;
		$data[$i][]=$courseId;
		$data[$i][]=$courseName;
		$data[$i][]=$semester;
		$data[$i][]=$start;
		$data[$i][]=$end;
		$data[$i][]=$instructor_first . " " . $instructor_last;
		$data[$i][]=$instructor_email;
		//$i++;
	}
}
		
//$tempcourse = " [ ";
if(isset($data)){
	$tempcourse = "";
	foreach($data as $line){
		$tempcourse .= '{
			"courseName": "' . $line[2] . '",
			"courseNumber": "' . $line[1] . '",
			"semester": "' . $line[3] . '",
			"startDate": "' . $line[4] . '",
			"endDate": "' . $line[5] . '", 
			"instructor": "' . $line[6] . '", 
			"email": "' . $line[7] . '", 
			"assistants":[ ';
		}
}

$ta_data="SELECT * FROM user_cohort 			
			JOIN class_list ON user_cohort.class_id=class_list.id
			JOIN person_role ON user_cohort.role_id=person_role.role_id
			JOIN users ON user_cohort.user_id = users.id
			WHERE person_role.role_id= 4
			AND class_list.course_number = '" . $courseId . "'";
			
$ta_result=pg_query($connect, $ta_data) or die ("Error in query:$ta_data.".pg_last_error($connect));
$k=0;

if(pg_num_rows($ta_result)>0){
	while($new=pg_fetch_array($ta_result)){
		$firstName = $new['first_name'];
		$lastName = $new['last_name'];
		$andrew = $new['andrew_id'];
		$class[$k][] = $firstName;
		$class[$k][] = $lastName;
		$class[$k][] = $andrew;
		$k++;
	}
}			

if(isset($class)){
	foreach($class as $obj){
		$tempcourse .=' {
		"firstName": "' . $obj[0] . '",
		"lastName": "' . $obj[1] . '",
		"andrewID": "' . $obj[2] . '" },';
	}
	$course = substr($tempcourse, 0, -1);
	$course .= " ] }";
	echo $course;
}
else{
	$course = substr($tempcourse, 0, -21);
	$course .= "}";
	echo $course;
}

?>

