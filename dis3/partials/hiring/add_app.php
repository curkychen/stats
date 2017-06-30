<?php
	include '../get/inc/db.php';
	$postdata = file_get_contents("php://input");
	$applicant = json_decode($postdata, true);

	$first_name = $applicant['firstName'];
	$last_name = $applicant['lastName'];
	$andrew_id = $applicant['andrewID'];
	$address = $applicant['address'];
	$phone_number = $applicant['phone'];
	$grad_year = $applicant['grad_year'];
	$ssn = $applicant['ssn'];
	$language = $applicant['language'];
	$ita = $applicant['ITA'];
	$ita_score = $applicant['ita_score'];
	$major_one = $applicant['majorOne'];
	$major_two = $applicant['majorTwo'];
	$minor = $applicant['minor'];
	$advisor = $applicant['advisor'];
	$preferred_courses = $applicant['preferred'];
	$relevant_skills = $applicant['experience'];
	$ta_ref = $applicant['reference'];
	$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
	$query="INSERT INTO ta_applications (id, first_name, last_name, andrew_id, address, phone_number, grad_year,
		ssn, first_language, ita, ita_score, major_one, major_two,
		minor, advisor, preferred_courses, relevant_skills, ta_ref) VALUES 
		(NULL, '" . $first_name . "', '" . $last_name . "', '" . $andrew_id . "', '" . $address . "', '" . $phone_number .
	 	"', '" . $grad_year . "', '" . $ssn . "', '" . $language . "', '" . $ita . "', '" . $ita_score . "', '" . $major_one . 
	 	"', '" . $major_two . "', '" . $minor . "', '" . $advisor . "', '" . $preferred_courses . "', '" . $relevant_skills . "', '" . $ta_ref . "')";
	$result=pg_query($connect,$query) or die ("Error in query:$query.".pg_last_error($connect));
	
	echo $app_id =mysqli_insert_id($connect); //NEED PG ALTERNATIVE TO GET ID!!!
	
	?>