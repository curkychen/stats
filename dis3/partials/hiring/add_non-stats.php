<?php
	include '../get/inc/db.php';
	$postdata = file_get_contents("php://input");
	$data = json_decode($postdata, true);
	$non_stats = $data['nonstats'];
	$prior_stats = $data['priorstats'];
	$prior_grading = $data['priorgrading'];
	$app_id = $data['appID'];
	
	foreach($non_stats as $course) {
		$class = $course['class'];
		$grade = $course['grade'];
		$instructor= $course['instructor'];
		$comment = $course['comment'];		
		$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
		$query="INSERT INTO nonstats (pk_priorgrading, coursenumber, grade, instructor,
	 		responsibilities, fk_application) VALUES (NULL, '" . $class . "', '" . $grade . "', '" 
	 		. $instructor . "', '" . $comment . "', '" . $app_id . "')";
		$result=pg_query($connect,$query) or die ("Error in query:$query.".pg_last_error($connect));
	}
	
	foreach($prior_stats as $course) {
		$class = $course['class'];
		$grade = $course['grade'];
		$instructor= $course['instructor'];
		$comment = $course['comment'];		
		$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
		$query="INSERT INTO priorstats (pk_priorgrading, coursenumber, grade, instructor,
	 		responsibilities, fk_application) VALUES (NULL, '" . $class . "', '" . $grade . "', '" 
	 		. $instructor . "', '" . $comment . "', '" . $app_id . "')";
		$result=pg_query($connect,$query) or die ("Error in query:$query.".pg_last_error($connect));
	}
	
	foreach($prior_grading as $course) {
		$class = $course['class'];
		$position = $course['position'];
		$instructor= $course['instructor'];
		$responsibilities = $course['responsibilities'];		
		$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
		$query="INSERT INTO priorgrading (pk_priorgrading, coursenumber, position, instructor,
	 		responsibilities, fk_application) VALUES (NULL, '" . $class . "', '" . $position . "', '" 
	 		. $instructor . "', '" . $responsibilities . "', '" . $app_id . "')";
		$result=pg_query($connect,$query) or die ("Error in query:$query.".pg_last_error($connect));
	}
	
?>