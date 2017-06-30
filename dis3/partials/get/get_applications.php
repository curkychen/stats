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
		$first_name = $row['first_name'];
		$last_name=$row['last_name'];
		if($row['andrew_id']){
			$email=$row['andrew_id'];
			$email .= '@andrew.cmu.edu';
		}
		
		$db[$i][]=$id;
		$db[$i][]=$first_name;
		$db[$i][]=$last_name;
		$db[$i][]=$email;
		
		$i++;
	}
}
//print_r($db);
$temp_app="[ ";
if(isset($db)){
	foreach ($db as $line) {
		$temp_app .= '{ 
		"id": "' . $line[0] . '",
		"firstName": "' . $line[1] . '", 
		"lastName": "' . $line[2] . '", 
		"email": "' . $line[3] . '",
		"name": "' . $line[2] . ', ' . $line[1] . '"},';
	}
	$app = substr($temp_app, 0, -1);	
	$app.=" ]";
	echo $app;
}
?>