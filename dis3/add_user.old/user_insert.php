<?php
function add_user($add_user){
	include('users/inc/db.php');
	$first_name = $add_user['first_name'];
	$last_name = $add_user['last_name'];
	$andrew_id = $add_user['andrew_id'];
	$email = $add_user['email'];
	//$user_password=$add_user['password'];
	//$color=$add_user['color_value'];
	//$pic=$add_user['image_src'];
	$connect=mysqli_connect($server, $user, $password, $database) or die ("could not connect to server!");
	//mysqli_select_db($connect, $database) or die ("Unable to connect to database!");
	$query="INSERT INTO `users` (`id` , `first_name` , `last_name` , `andrew_id` , `password` , `email` , `color_value` , `image_src`) VALUES (NULL, '" . $first_name . "', '" . $last_name . "', '" . $andrew_id . "', '" . $user_password . "', '" . $color . "', '" . $email . "', '" . $pic . "')";
	$result=mysqli_query($connect,$query) or die ("Error in query:$query.".mysqli_error($connect));
	
	//$user_id = mysqli_insert_id($connect);
	//return $user_id;
	$ForwardTo="Location: http://www.stat.cmu.edu/~zgreen/SIS/index.html#/people";
	header($forwardTo);
}
?>