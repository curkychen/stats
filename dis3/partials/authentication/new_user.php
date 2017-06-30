<?php
	$postdata = file_get_contents("php://input");
	$add_user = json_decode($postdata, true);
	include('inc/db.php');
	
	$first_name = $add_user['firstName'];
	$last_name = $add_user['lastName'];
	$nickname = $add_user['nickName'];
	$gender = $add_user['gender'];
	$input_email = $add_user['email'];
	$user_password=$add_user['password'];
	$user_role = $add_user['role'];
	if(isset($add_user['joint']){
		$joint = $add_user['joint'];
	}
	else{
		$joint = "No";
	}
	$pic=$add_user['imageSrc'];
	
	if( strstr($email, 'cmu.edu') == 'cmu.edu'){
		$arr = array('msg' => "", 'error' => 'andrew login');
		$jsn = json_encode($arr);
		print_r($jsn);
	}
	else{
		$connect=pg_connect("host=$server dbname=$database user=$user password=$password");
		$checkUserQuery = "SELECT * FROM users";
		$checkResult = pg_query($connect, $checkUserQuery) or die ("Error in query:$checkUserQuery.".pg_last_error($connect));
		$i = 0;
		if(pg_num_rows($checkResult) > 0){
			while($row = pg_fetch_assoc($checkResult)){
				$email = $row['email_address'];
				$pw = $row['password'];
		
				$slot[$i][] = $email;
				$slot[$i][] = $pw;
				$i++;
			}
		}
		foreach($slot as $data){
			if($data[0] == $input_email && $data[1] == $user_password){
				$arr = array('msg' => "", 'error' => "user exists");
				$jsn = json_encode($arr);
				print_r($jsn);
			}
			else if(strstr($input_email, 'cmu.edu') == 'cmu.edu'){
				$arr = array('msg' => "", 'error' => "andrew");
				$jsn = json_encode($arr);
				print_r($jsn);
			}
			else {
				$query="INSERT INTO users (id , first_name , last_name , password , email_address , image_src, is_admin , andrew_id) 
					VALUES (DEFAULT, '" . $first_name . "', '" . $last_name . "', '" . $user_password . "', '"  . $email . "', '" . $pic .  "', 1, '" . $andrew_id . "')";
				//$result=pg_query($connect, $query) or die ("Error in query:$query.".pg_last_error($connect));
				print_r($query);
				$arr = array('msg' => 'success', 'error' => '');
				$jsn = json_encode($arr);
				print_r($jsn);
			}
		}		
	}

?>