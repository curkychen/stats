<?php

include 'inc/db.php';
$url = $_SERVER['REQUEST_URI'];
// the user ID is a 1-3 digit integer AFTER / in the URL 
$userIdIndexStart = strrpos($url, "/") + 1;
$userId = substr($url, $userIdIndexStart);
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

if($userId != 'undefined'){
	$user_data="SELECT * FROM users WHERE id='" . $userId . "'";
	$user_result=pg_query($connect, $user_data) or die ("Error in query:$user_data.".pg_last_error($connect));
	$i=0;

	if(pg_num_rows($user_result)>0){
		while($row=pg_fetch_array($user_result)){
			$id=$row['id'];
			$first_name=$row['first_name'];
			$last_name=$row['last_name'];
			$active=$row['active'];
			$gender=$row['gender'];
			if($row['nickname']){	
				$nickname = "(" . $row['nickname'] . ")";
			}
			else{
				$nickname = "";
			}
			if($row['andrew_id']){
				$email = $row['andrew_id']; 
				$email .= '@andrew.cmu.edu';
			}
			else{
				$email=$row['email_address'];
			}
		}
	}
		
	$tempuser="";
		$tempuser.= '{ 
		"firstName": "' . $first_name . '", 
		"lastName": "' . $last_name . '", 
		"preferredName": "(' . $nickname . ')",
		"email": "' . $email . '",
		"gender": "' . $gender . '",
		"id": "' . $id . '", ';
	
	$class_data="SELECT * FROM user_cohort 
	JOIN class_list ON user_cohort.class_id = class_list.id
	JOIN person_role ON user_cohort.role_id = person_role.role_id
	WHERE user_id = " . $userId;
	$class_result=pg_query($connect, $class_data) or die ("Error in query:$class_data.".pg_last_error($connect));
	$k=0;

	if(pg_num_rows($class_result)>0){
		while($new=pg_fetch_array($class_result)){
			$id=$new['id'];
			$course=$new['course_name'];
			$course_number=$new['course_number'];
			$role=$new['user_role'];
			$semester=$new['semester'];
			$start_date=$new['start_date'];
			$end_date=$new['end_date'];
			$class[$k][]=$id;
			$class[$k][]=$course;
			$class[$k][]=$course_number;
			$class[$k][]=$role;
			$class[$k][]=$start_date;
			$class[$k][]=$end_date;
			$k++;
		}
	}			

	if(isset($class)){
		$tempuser .= '"classes":[';
		foreach($class as $obj){
			$tempuser .= '{ 
			"id": "' . $obj[0] . '",
			"courseName": "' . $obj[1] . '",
			"role": "' . $obj[3] . '",
			"courseNumber": "' . $obj[2] . '",
			"startDate": "' . $obj[4] . '",
			"endDate": "' . $obj[5] . '"},';
		}
		$user = substr($tempuser, 0, -1);
		$user .= '],';
	}
	else {
		$user = $tempuser;
	}

	$classes_taught_data="SELECT * FROM class_list
	WHERE instructor_id = " . $userId;
	$classes_taught_result=pg_query($connect, $classes_taught_data) or die ("Error in query:$classes_taught_data.".pg_last_error($connect));
	$p=0;

	if(pg_num_rows($classes_taught_result)>0){
		while($new=pg_fetch_array($classes_taught_result)){
			$id=$new['id'];
			$course=$new['course_name'];
			$course_number=$new['course_number'];
			$semester=$new['semester'];
			$start_date=$new['start_date'];
			$end_date=$new['end_date'];
			$classTaught[$p][]=$id;
			$classTaught[$p][]=$course;
			$classTaught[$p][]=$course_number;
			$classTaught[$p][]=$start_date;
			$classTaught[$p][]=$end_date;
			$p++;
		}
	}

	if(isset($classTaught)){
		$user .= '"classesTaught":[';
		foreach($classTaught as $obj){
			$user.='{ 
			"id": "' . $obj[0] . '",
			"courseName": "' . $obj[1] . '",
			"courseNumber": "' . $obj[2] . '",
			"startDate": "' . $obj[3] . '",
			"endDate": "' . $obj[4] . '"},';
		}
		$newUser1 = substr($user, 0, -1);
		$newUser1 .= '],';
	}
	else {
		$newUser1 = $user;
	}
	
	$position_query = "SELECT * FROM user_position
					  JOIN users ON users.id = user_position.user_id
					  JOIN position ON position.id = user_position.position_id
					  WHERE user_id = " . $userId;
	$position_result = pg_query($connect, $position_query) or die("Error in Query: $position_query.".pg_last_error($connect));
	
	$q = 0;
	
	if(pg_num_rows($position_result)>0){
		while($pos = pg_fetch_assoc($position_result)){
			$id = $pos['up_id'];
			$posId = $pos['position_id'];
			$posName = $pos['position_name'];
			$pos_start = $pos['start_date'];
			$pos_end = $pos['end_date'];
			
			$newPos[$q][] = $posId;
			$newPos[$q][] = $posName;
			$newPos[$q][] = $pos_start;
			$newPos[$q][] = $pos_end;
			$newPos[$q][] = $id;
			$q++;
		}
	}
	
	if(isset($newPos)){
		$newUser1 .= '"positionList": [';
		foreach($newPos as $line){
			$newUser1 .= '{
				"position": "' . $line[1] . '",  
				"positionId": "' . $line[0] . '",
				"startDate": "' . $line[2] . '",
				"endDate": "' . $line[3] . '",
				"posFull": "' . $line[1] . " - " . $line[3] . '",
				"upID": "' . $line[4] . '"},';
		} 
		$newUser = substr($newUser1, 0, -1);
		$newUser .= '],';
	}
	else{
		$newUser = $newUser1;
	}
	
	$key_query = "SELECT * FROM person_keys
				  JOIN users ON users.id = person_keys.user_id
				  JOIN keys ON keys.key_id = person_keys.key_id
				  WHERE users.id = " . $userId;
	$keyResult = pg_query($connect, $key_query) or die("Error in Query: $key_query.".pg_last_error($connect));
	$z = 0;
	
	if(pg_num_rows($keyResult)>0){
		while($pk = pg_fetch_assoc($keyResult)){
			$keyId = $pk['key_id'];
			$keyNum = $pk['key_ident_str'];
			$key[$z][] = $keyId;
			$key[$z][] = $keyNum;
			$z++;
		}
	}
	
	if(isset($key)){
		$newUser .= '"keyList": [';
		foreach($key as $newKey){
			$newUser .= '{
			"keyNumber":"' . $newKey[1] . '",
			"keyId":"' . $newKey[0] . '"},';
		}
		$userKey = substr($newUser, 0, -1);
		$userKey .= '],';
	}
	else{
		$userKey = substr($newUser, 0, -1);
		$userKey .= ',';
	}
	
	$r_query = "SELECT ur_id, rel_start, rel_end, relationship, u2.first_name AS fn, u2.last_name AS ln, u2.andrew_ID AS aid 
					FROM user_relationships
						JOIN relationships ON relationships.id = user_relationships.rel_type_id
						JOIN users u1 ON u1.id=user_relationships.user_id_1
						JOIN users u2 ON u2.id=user_relationships.user_id_2 
						WHERE user_id_1 =  " . $userId;
	$relationResult = pg_query($connect, $r_query) or die("Error in Query: $r_query.".pg_last_error($connect));
	$t=0;
	
	if(pg_num_rows($relationResult)>0){
		while($rr = pg_fetch_assoc($relationResult)){
			$relationId = $rr['ur_id'];
			$relationship = $rr['relationship'];
			$relationWithFN = $rr['fn'];
			$relationWithLN = $rr['ln'];
			$relationWithAndrew = $rr['aid'];
			$relationStart = $rr['rel_start'];
			$relationEnd = $rr['rel_end'];
			$rel[$t][] = $relationship;
			$rel[$t][] = $relationWithFN;
			$rel[$t][] = $relationWithLN;
			$rel[$t][] = $relationStart;
			$rel[$t][] = $relationEnd;
			$rel[$t][] = $relationId;
			$t++;
		}
	}
	
	if(isset($rel)){
		$userKey .= '"relationshipList": [';
		foreach($rel as $nr){
			$userKey .= '{
				"rId": "' . $nr[5] . '",
				"relationship": "' . $nr[0] . '",
				"relStart": "' . $nr[3] . '",
				"relEnd": "' . $nr[4] . '",
				"relWithFirst": "' . $nr[1] . '",
				"relWithLast": "' . $nr[2] . '",
				"relFull": "' . $nr[0] . ' - ' . $nr[1] . ' ' . $nr[2] . '"},';
		}
		$userRel = substr($userKey, 0, -1);
		$userRel .= ']}';
		echo $userRel;
	}
	else{
		$userRel = substr($userKey, 0, -1);

		// Edge case where user doesn't have anything connected to it and there's an extra comma at the end
		// Remove extra comma
		if(substr($userRel, -1) == ',') {
			$userRel = substr($userRel, 0, -1);
		}

		$userRel .= '}';
		echo $userRel;
	}
}
?>
