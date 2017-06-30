<?php 

include '../get/inc/db.php';
$postdata = file_get_contents("php://input");
$add_class = json_decode($postdata, true);


// $course_name = $add_class['name'];

$course_name = $add_class['name'];
$course_number = $add_class['number'];
$instructor_id = $add_class['instructor_id'];
// $instructor = $add_class['instructor'];
// $instructor_email = $add_class['email'];
$semester = $add_class['semester'];
$start_date= $add_class['startDate'];
$end_date = $add_class['endDate'];
// $instructor_phone = $add_class['phone'];

$connection_id=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$class_query="INSERT INTO class_list (id , course_number , course_name , semester , start_date , end_date , instructor_id) VALUES (DEFAULT, '" . $course_number . "' , '" . $course_name . "' , '" . $semester . "' , '" . $start_date . "' , '" . $end_date . "' , '" . $instructor_id . "')";
$result=pg_query($connection_id, $class_query) or die ("Error in query:$class_query".pg_last_error($connection_id));

//assuming only one TA is added
if($add_class['TA_fname']!="" AND $add_class['TA_lname']!="" AND $add_class['TA_andrew']!=""){
	//get_class_id 
	$get_class_query = "SELECT id FROM class_list 
					   WHERE course_name = '" . $course_name . "'";

	$get_class_result = pg_query($connection_id, $get_class_query) or die ("Error in query:$get_class_query".pg_last_error($connection_id));
	if(pg_num_rows($get_class_result)>0){
		while($row = pg_fetch_assoc($get_class_result)){
			$class_id = $row['id'];
		}
	}

	//TA query 
	$firstName = $add_class['TA_fname'];
	$lastName = $add_class['TA_lname'];
	$andrew = $add_class['TA_andrew'];
	$email = $andrew . "@andrew.cmu.edu";
	$select_statement = $firstName . ", " . $lastName . ", " . $andrew . ", " . $email; 
	$role_id = 4;

	// Insert TA in users if not exists
	$check_TA_query = "INSERT INTO users (first_name, last_name, andrew_id, email_address) 
					   SELECT '" . $firstName . "', '" . $lastName . "', '" . $andrew . "', '" . $email . "' WHERE NOT EXISTS ( SELECT id from users WHERE andrew_id = '" . $andrew . "')";

	$check_TA_result = pg_query($connection_id, $check_TA_query) or die ("Error in query:$check_TA_query".pg_last_error($connection_id));

	// Get user_id 
	$get_user_query = "SELECT id FROM users 
					   WHERE andrew_id = '" . $andrew . "'";

	$get_user_result = pg_query($connection_id, $get_user_query) or die ("Error in query:$get_user_query".pg_last_error($connection_id));

	if(pg_num_rows($get_user_result)>0){
		while($row = pg_fetch_assoc($get_user_result)){
			$user_id = $row['id'];
		}
	}
	// Insert user_id, class_id and role_id into user_cohort
	$TA_query="INSERT INTO user_cohort (user_id, class_id, role_id) VALUES (" . $user_id . ", " . $class_id . ", " . $role_id . ")";
	$TA_query_result = pg_query($connection_id, $TA_query) or die ("Error in query:$TA_query".pg_last_error($connection_id));
}


?>