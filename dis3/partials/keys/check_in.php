<?php

include 'inc/db.php';

//getUrl and key number
$url = $_SERVER['REQUEST_URI'];
//$keyNumber = substr($url, 40);

$keyNumber = substr(strrchr(rtrim($url, '/'), '/'), 1);

//get user id from form data
$postdata = file_get_contents("php://input");
$check_in = json_decode($postdata, true);
$personId = $check_in['uid'];

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$get_key_query = "SELECT * FROM keys WHERE key_ident_str = '" . $keyNumber . "'";
$get_key_result = pg_query($connect, $get_key_query)or die ("Error in query:$get_key_query.".pg_last_error($connect));

if(pg_num_rows($get_key_result)>0){
	while($row=pg_fetch_array($get_key_result)){
		$keyId = $row['key_id'];
	}
}

$query_return_key = "DELETE FROM person_keys WHERE person_id = " . $personId . " AND key_id = " . $keyId;
$result_return_key = pg_query($connect, $query_return_key);

$query_checkin = "INSERT INTO person_keys (person_id, key_id, deposit_paid, deposit_date) 
										VALUES (1, " . $keyId . ", 0, NULL)";
$result_checkin = pg_query($connect, $query_checkin);
	
?>
