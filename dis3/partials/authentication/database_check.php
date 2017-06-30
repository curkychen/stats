<?php
include('inc/db.php');
$postdata = file_get_contents("php://input");
$add_user = json_decode($postdata, true);

$input_EM = $add_user['email'];
$input_PW = $add_user['disPw'];
	
$connect = pg_connect("host=$server dbname=$database user=$user password=$password");

if( strstr($input_EM, 'cmu.edu') == 'cmu.edu'){
	$arr = array('msg' => "", 'error' => 'andrew login');
	$jsn = json_encode($arr);
	print_r($jsn);
}
else{
	$checkUserQuery = "SELECT * FROM users WHERE email_address = '" . $input_EM . "'";
	$checkResult = pg_query($connect, $checkUserQuery) or die ("Error in query:$checkUserQuery.".pg_last_error($connect));


	if(pg_num_rows($checkResult) > 0){
		while($row = pg_fetch_assoc($checkResult)){
			$email = $row['email_address'];
			$pw = $row['password'];
		
		if($pw == $input_PW){
			$arr = array('msg' => "success!", 'error' => '');
			$jsn = json_encode($arr);
			print_r($jsn);
			//$url = "$https://www.stat.cmu.edu/~zgreen/DIS/partials/authentication/congrats.html";
			//header($url);
		}
		else if($email == $input_EM && $pw != $input_PW){
			$arr = array('msg' => "", 'error' => 'Wrong Password!');
			$jsn = json_encode($arr);
			print_r($jsn);
		}
		
		}
	}
	else{
		$arr = array('msg' => "", 'error' => 'User not recognized!');
		$jsn = json_encode($arr);
		print_r($jsn);
	}	
}
?>