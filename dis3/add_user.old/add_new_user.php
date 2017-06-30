<?php

include('user_insert.php');
$add_user['first_name']=$_POST['first_name'];
$add_user['last_name']=$_POST['last_name'];
$add_user['andrew_id']=$_POST['andrew_id'];
$add_user['password']=$_POST['password'];
$add_user['color_value']=$_POST['color_value'];
$add_user['email_preferred'] = $_POST['email'];

add_user($add_user);

?>