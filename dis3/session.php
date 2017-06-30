<?php
include 'inc/db.php';
session_start();

//get the first_name, last_name, andrew_id somehow
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$session_query = "SELECT first_name, last_name FROM users WHERE andrew_id = '" . $andrew_id;
$query_result = pgquery($connect, $session_query) or die ("Error in query:$session_query.".pg_last_error($connect));
$i = 0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$data[$i][] = $first_name;
		$data[$i][] = $last_name;
		$i++;
	}
}
$temp=" [ ";
if(isset($data)){
	foreach ($data as $line) {
		$temp .= '{
			"first_name": "' . $line[0] . '",
			"last_name":'
	}
}

?>