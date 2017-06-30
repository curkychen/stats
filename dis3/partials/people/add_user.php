<?php

include '../get/inc/db.php';
echo "enter the add user!";
$postdata = file_get_contents("php://input");
$add_user = json_decode($postdata, true);


$first_name = $add_user['firstName'];
$last_name = $add_user['lastName'];
$andrew_id = $add_user['andrewID'];
$email = $add_user['email'];

// Check if gender is empty
if ($add_user['gender']!=""){
	$gender = $add_user['gender'];
} else {
	$gender = '';
};


if ($add_user['pic']!=""){
    $base_path = "http://sp.stat.cmu.edu/dis/uploads/people/";
    $time = date("Y-m-d-H");
    $pic_name = $base_path . $time . "_" . $add_user['pic'];
} else {
	$pic_name = '';
};

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
//$query="INSERT INTO `users` (`id` , `first_name` , `last_name` , `andrew_id` , `password` , `color_value` , `email_address` , `image_src`) VALUES (NULL, '" . $first_name . "', '" . $last_name . "', '" . $andrew_id . "', '" . $pw . "', '" . $color . "', '" . $email . "', '" . $pic . "')";
$query="INSERT INTO users (id , first_name , last_name , email_address, andrew_id, image_src, gender) VALUES (DEFAULT, '" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $andrew_id . "','" . $pic_name .  "' , '" . $gender . "')";
$result=pg_query($connect,$query) or die ("Error in query:$query.".pg_last_error($connect));

// Add position - if exists
// if ($add_user['pId']!="" AND $add_user['start_date']!=""){

$position = ", " . $add_pos['pId'];
$start = ", '" . substr($add_pos['startDate'], 0, -14) . "', ";

if ($add_pos['endDate'] == '') {
	$end = "NULL";
} else {
	$end =  "'" . substr($add_pos['endDate'], 0, -14) . "'";
}

$add_pos_query = "INSERT INTO user_position (user_id, position_id, start_date, end_date) VALUES (" . $user . $position . $start . $end . ")";
$add_pos_result = pg_query($connect, $add_pos_query) or die ("Error in Query:$add_pos_query.".pg_last_error($connect));



// below are previous commented;


// }

// // Add relationships - if they exist
// if ($add_user['rId']!="" AND $add_user['relStart']!="" AND $add_user['relEnd']!="" AND $add_user['relName']!=""){

// 	// Find the id of the primary user 
// 	$get_user_query = "SELECT id FROM users 
// 					   WHERE andrew_id = '" . $andrew_id . "'";

// 	$get_user_result = pg_query($connect, $get_user_query) or die ("Error in query:$get_user_query".pg_last_error($connect));
// 	if(pg_num_rows($get_user_result)>0){
// 		while($row = pg_fetch_assoc($get_user_result)){
// 			$user_id = $row['id'];
// 		}
// 	}

// 	// Relationships query
// 	$relId = $add_user['rId'];
// 	$relStart = $add_user['relStart'];
// 	$relEnd = $add_user['relEnd'];
// 	$relName = $add_user['relName']; // This is the user_2 id 
// 	$select_statement = $user_id . "," . $relStart . ", " . $relEnd . ", " . $relId . ", " . $relName; 

// 	// Insert relationship in to user_relationship 
// 	$rel_query="INSERT INTO user_relationships (user_id_1, rel_start, rel_end, rel_type_id, relName) VALUES (" . $select_statement . ")";

// 	$add_rel_result = pg_query($connect, $rel_query) or die ("Error in Query:$rel_query.".pg_last_error($connect));
// }

// // Add from here down to people.html form 
// // Add role - if exists 
// if ($add_user['course']!="" AND $add_user['role']!=""){

// 	// Set variables
// 	$class_id = $userCourse['course'];
// 	$role_id = $userCourse['role'];

// 	$add_role_query = "INSERT INTO user_cohort (user_id , class_id , role_id) VALUES ('" . $userId . "', '" . $class_id . "', '" . $role_id . "')";
// 	$add_role_result = pg_query($connect, $add_role_query) or die ("Error in query:$add_role_query.".pg_last_error($connect));
// }

// Add keys owned? 

?>