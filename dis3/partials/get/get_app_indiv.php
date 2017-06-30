<?php
include 'inc/db.php';
$url = $_SERVER['REQUEST_URI'];

$appIdIndexStart = strrpos($url, "/") + 1;
$appId = substr($url, $appIdIndexStart);

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$app_indiv_query = "SELECT * FROM ta_applications 
					LEFT JOIN application_status ON application_status.app_id = ta_applications.id  
					WHERE ta_applications.id = '" . $appId . "'
					ORDER BY date_changed DESC
					LIMIT 1";
$app_result = pg_query($connect, $app_indiv_query) or die ("Error in query:$room_indiv_query.".pg_last_error($connect));

$i = 0;
if(pg_num_rows($app_result)>0){
	while($row = pg_fetch_assoc($app_result)){
		$id=$row['id'];
		$first_name = $row['first_name'];
		$last_name=$row['last_name'];
		if($row['andrew_id']){
			$email=$row['andrew_id'];
			$email .= '@andrew.cmu.edu';
		}
		$address = $row['address'];
		$phone_number=$row['phone_number'];
		$ssn = $row['ssn'];
		$grad_year=$row['grad_year'];
		$first_language=$row['first_language'];
		$ita=$row['ita'];
		if($ita == 'Yes'){
			$ita_score=$row['ita_score'];
		}
		else{
			$ita_score= 'Did not take the ITA';
		}
		$major_one=$row['major_one'];
		//major two optional 
		if($row['major_two']!='none'){
			$major_two = $row['major_two'];
		}
		else{
			$major_two = 'No second major';
		}
		if($row['minor']!= 'none'){
			$minor = $row['minor'];
		}
		else{
			$minor = 'No Minor';
		}
		$advisor = $row['advisor'];
		$preferred_courses = $row['preferred_courses'];
		$relevant_skills = $row['relevant_skills'];
		$ta_ref = $row['ta_ref'];
		$status = $row['status'];
		$sent = $row['sent'];
		$date_changed = $row['date_changed'];
		$comments = $row['other_comments'];

		$db[$i][]=$id;
		$db[$i][]=$first_name;
		$db[$i][]=$last_name;
		$db[$i][]=$email;
		$db[$i][]=$address;
		$db[$i][]=$phone_number;
		$db[$i][]=$ssn;
		$db[$i][]=$grad_year;
		$db[$i][]=$first_language;
		$db[$i][]=$ita;
		//if($ita == "Yes"){
			$db[$i][]=$ita_score;
		//}
		$db[$i][]=$major_one;
		//if($major_two!= ''){
			$db[$i][]=$major_two;
		//}
		//if($minor!= ''){
			$db[$i][]=$minor;
		//}
		$db[$i][]=$advisor;
		$db[$i][]=$preferred_courses;
		$db[$i][]=$relevant_skills;
		$db[$i][]=$ta_ref;
		$db[$i][]=$status;
		$db[$i][]=$sent;
		$db[$i][]=$date_changed;
		$db[$i][]=$comments;
		
		$i++;
	}
}
//print_r($db);

if(isset($db)){
	foreach ($db as $line) {
		$temp_app = '{ 
		"id": "' . $line[0] . '",
		"firstName": "' . $line[1] . '", 
		"lastName": "' . $line[2] . '", 
		"email": "' . $line[3] . '",
		"name": "' . $line[2] . ', ' . $line[1] . '",
		"address": "' . $line[4] . '",
		"phoneNumber": "' . $line[5] . '",
		"ssn": "' . $line[6] . '",
		"gradYear": "' . $line[7] . '",
		"firstLang": "' . $line[8] . '",		
		"ita": "' . $line[9] . '",
		"itaScore": "' . $line[10] . '",
		"majorOne": "' . $line[11] . '",
		"majorTwo": "' . $line[12] . '",
		"minor": "' . $line[13] . '",
		"advisor": "' . $line[14] . '",
		"preferredCourses": "' . $line[15] . '",
		"skills": "' . $line[16] . '",
		"taRef": "' . $line[17] . '",
		"appStatus": "' . $line[18] . '",
		"appSent": "' . $line[19] . '",
		"dateChanged": "' . $line[20] . '",
		"changeComments": "' . $line[21] . '"}';
	}

	echo $temp_app;
}
?>