<?php
include 'inc/db.php';

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$data="SELECT * FROM users WHERE active = 1 AND id IN
(SELECT user_position.user_id
FROM user_position
JOIN users
ON user_position.user_id = users.id
WHERE LOWER(user_position.track) LIKE '%prof%'
GROUP BY user_position.user_id
ORDER BY user_position.user_id)";

$result=pg_query($connect, $data) or die ("Error in query:$data.".pg_last_error($connect));
$i=0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		$id=$row['id'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$active = $row['active'];
		if($row['nickname']){
			$nickname = "(" . $row['nickname'] . ")";
		}
		else{
			$nickname = "";
		}
		
		if($row['andrew_id']){
			$email=$row['andrew_id'];
			$email .= '@andrew.cmu.edu';
		}
		else{
			$email = $row['email_address'];
		}
		
		$db[$i][]=$id;
		$db[$i][]=$first_name;
		$db[$i][]=$last_name;
		$db[$i][]=$email;
		$db[$i][]=$active;
		$db[$i][]=$nickname;
		$i++;
	}
}		
$tempuser="[ ";
if(isset($db)){
	foreach($db as $line){
			$tempuser.= '{ 
			"id": "' . $line[0] . '",
			"firstName": "' . $line[1] . '", 
			"lastName": "' . $line[2] . '", 
			"email": "' . $line[3] . '",
			"name": "' . $line[2] . ', ' . $line[1] . ' ' . $line[5] . '", 
			"active": "' . $line[4] . '"},';
	}
	$user = substr($tempuser, 0, -1);	
	$user.=" ]";
	echo $user;
}
		
?>