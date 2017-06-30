<?php 
include ('inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

/* sort by the semester, but semester not alphabetical. Sorting by start_date for simplicity. */
$query="SELECT * FROM class_list ORDER BY start_date DESC";
$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));

$i=0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		$courseId=$row['id'];
		$courseNum=$row['course_number'];
		$courseName=$row['course_name'];
		$semester=$row['semester'];
		$start=$row['start_date'];
		$end=$row['end_date'];
		$instructor_id=$row['instructor_id'];
		// $email=$row['instructor_email'];
		$data[$i][]=$courseId;
		$data[$i][]=$courseNum;
		$data[$i][]=$courseName;
		$data[$i][]=$semester;
		$data[$i][]=$start;
		$data[$i][]=$end;
		$data[$i][]=$instructor_id;
		// $data[$i][]=$email;
		$i++;
		}
	}
$tempcourse=" [ ";
if(isset($data)){
	foreach($data as $line){
		$tempcourse .= '{
			"id": "' . $line[0] . '",
			"courseName": "' . $line[2] . '",
			"courseNumber": "' . $line[1] . '",
			"semester": "' . $line[3] . '",
			"startDate": "' . $line[4] . '",
			"endDate": "' . $line[5] . '",
			"instructor_id": "' . $line[6] . '" },';
		}
	$course=substr($tempcourse, 0, -1);
	$course.= " ]";
	echo $course;
	}
?>
