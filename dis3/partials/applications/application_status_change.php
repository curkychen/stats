<?php

include 'inc/db.php';
$postdata = file_get_contents("php://input");
$status_change = json_decode($postdata, true);

$url = $_SERVER['REQUEST_URI'];
$appIdIndexStart = strrpos($url, "/") + 1;
$appId = substr($url, $appIdIndexStart);

$status = $status_change['status'];
$sent = $status_change['sent'];
$comments = $status_change['comments'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$query="INSERT INTO application_status (app_id, status, sent, other_comments) 
		VALUES ('". $appId . "' , '" . $status . "' , '" . $sent . "', '" . $comments . "')";
echo $query;
$result=pg_query($connect, $query) or die ("Error in query:$query".pg_last_error($connect));

?>