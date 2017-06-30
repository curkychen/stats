<?php 
include 'inc/db.php';
$url = $_SERVER['REQUEST_URI'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$data="SELECT * FROM ta_applications;";
$result=pg_query($connect, $data) or die ("Error in query:$data.".pg_last_error($connect));
$i=0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		$id=$row['id'];
		$last_name=$row['last_name'];
		if($row['andrew_id']){
			$email=$row['andrew_id'];
			$email .= '@andrew.cmu.edu';
		}
		$phone_number=$row['phone_number'];
		$grad_year=$row['grad_year'];
		$first_language=$row['first_language'];
		$ita=$row['ita'];
		// if($row['ita_score']!=nil){
		// 	$ita_score=$row['ita_score'];
		// }
		$major_one=$row['major_one'];
		// //major two optional 
		// if($row['major_two']!=nil){
		// 	$major_two = $row['major_two'];
		// }
		// if($row['minor']!=nil){
		// 	$minor = $row['minor'];
		// }
		$advisor = $row['advisor'];
		$preferred_courses = $row['preferred'];
		$relevant_skills = $row['experience'];
		$ta_ref = $row['reference'];

		$db[$i][]=$id;
		$db[$i][]=$first_name;
		$db[$i][]=$last_name;
		$db[$i][]=$email;
		$db[$i][]=$phone_number;
		$db[$i][]=$grad_year;
		$db[$i][]=$first_language;
		$db[$i][]=$ita;
		// if($ita=="No"){
		// 	$db[$i][]=$ita_score;
		// }
		$db[$i][]=$major_one;
		// if($major_two!=nil){
		// 	$db[$i][]=$major_two;
		// }
		// if($minor!=nil){
		// 	$db[$i][]=$minor;
		// }
		$db[$i][]=$advisor;
		$db[$i][]=$preferred_courses;
		$db[$i][]=$relevant_skills;
		$db[$i][]=$ta_ref;
		$i++;
	}
}
$temp_app="[ ";
if(isset($db)){
	foreach ($db as $line => $value) {
		$tempapp.= '{ 
		"id": "' . $line[0] . '",
		"firstName": "' . $line[1] . '", 
		"lastName": "' . $line[2] . '", 
		"email": "' . $line[3] . '",
		"name": "' . $line[2] . ', ' . $line[1] . '",;
		"phoneNumber": "' . $line[4] . '",
		"gradYear": "' . $line[5] . '",
		"firstLang": "' . $line[6] . '",		
		"ita": "' . $line[7] . '",
		"majorOne": "' . $line[8] . '",
		"advisor": "' . $line[9] . '",
		"preferredCourses": "' . $line[10] . '",
		"taRef": "' . $line[11] . '" },';
	}
	$app = substr($temp_app, 0, -1);	
	$app.=" ]";
	echo $app;
}
?>