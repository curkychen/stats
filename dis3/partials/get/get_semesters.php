<?php 

	include ('inc/db.php');
	$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
	
	$course_query="SELECT * FROM semester_list";
	$course_result=pg_query($connect, $course_query) or die ("Error in query:$course_query.".pg_last_error($connect));
	if(pg_num_rows($course_result)>0){
		while($row=pg_fetch_assoc($course_result)){
			$semester=$row['semester_name'];
			$id=$row['id'];
		}
	}	

	$i = 0;
	$query_get_room="SELECT * FROM semester_list";
	$semester_result=pg_query($connect, $course_query) or die("Error in query:$course_query.".pg_last_error($connect));
	if(pg_num_rows($semester_result)>0){
		while($row=pg_fetch_assoc($semester_result)){
			$id=$row['id'];
			$semester=$row['semester_name'];
			$data[$i][]=$id;
			$data[$i][]=$semester;
			$i++;
		}
	}
	
	$tempsemester=" [ ";
		if(isset($data)){
			foreach($data as $line){
				$tempsemester .= '{
					"id": "' . $line[0] . '",
					"semester": "' . $line[1] . '" },';
			}
			$sem=substr($tempsemester, 0, -1);
			$sem.= " ]";
			echo $sem;
		}

?>