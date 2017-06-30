<?php
include 'inc/db.php';
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$postdata = file_get_contents("php://input");
$userCourse = json_decode($postdata, true);

$url = $_SERVER['REQUEST_URI'];
//print_r($url);
$userId = substr($url, 42);
//print_r($userId);

$class_id = $userCourse['course'];
$role_id = $userCourse['role'];

$query = "INSERT INTO user_cohort (user_id , class_id , role_id) VALUES ('" . $userId . "', '" . $class_id . "', '" . $role_id . "')";
$result = pg_query($connect, $query) or die ("Error in query:$query.".pg_last_error($connect));

?>