<?php
include 'inc/db.php';

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$query="SELECT DISTINCT u.id, u.first_name, u.last_name 
		FROM users as u 
		JOIN user_position as up
		ON u.id = up.user_id 
		WHERE up.position_id IN (3,4,5,6,7,8,9,10,13,24)";
$result=pg_query($connect, $query) or die ("Error in query:$query.".pg_last_error($connect));
$i=0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		$id=$row['id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		
		$db[$i][]=$id;
		$db[$i][]=$first_name;
		$db[$i][]=$last_name;
		$i++;
	}
}		
$tempuser="[ ";
if(isset($db)){
	foreach($db as $line){
			$tempuser.= '{ 
			"id":"' . $line[0] . '",
			"firstName": "' . $line[1] . '", 
			"lastName": "' . $line[2] . '"},';
	}
	$instructor = substr($tempuser, 0, -1);	
	$instructor.=" ]";
	echo $instructor;
}
		
?>