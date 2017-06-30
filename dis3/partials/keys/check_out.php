<?php

include '../get/inc/db.php';

$url = $_SERVER['REQUEST_URI'];
//$keyNumber = substr($url, 41);

$keyNumber = substr(strrchr(rtrim($url, '/'), '/'), 1);

$postdata = file_get_contents("php://input");
$check_out = json_decode($postdata, true);
$personId = $check_out['id'];


$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$get_key_query = "SELECT * FROM keys WHERE key_ident_str = '" . $keyNumber . "'";
$get_key_result = pg_query($connect, $get_key_query)or die ("Error in query:$get_key_query.".pg_last_error($connect));


if(pg_num_rows($get_key_result)>0){
	while($row=pg_fetch_array($get_key_result)){	
		$keyId = $row['key_id'];
	}
}

$check_out_query = "INSERT INTO person_keys (person_id, key_id, deposit_paid, deposit_date) 
					VALUES (" . $personId . ", " . $keyId . ", 0, NULL)";
$check_out_result = pg_query($connect, $check_out_query);

$query_count_keys = "SELECT COUNT(*) AS admin_keys FROM person_keys WHERE key_id = " . $keyId . " AND person_id = 1";
	
	$result_count_keys = pg_query($connect,$query_count_keys);
	$admin_keys_row = pg_fetch_assoc($result_count_keys);
	$admin_keys = $admin_keys_row[admin_keys] - 1;
	
	$query_delete_keys = "DELETE FROM person_keys WHERE key_id = " . $keyId . " AND person_id = 1";
	$result_delete_keys = pg_query($connect, $query_delete_keys);

	for($i=0; $i<$admin_keys; $i++) {
		$query_reinsert_keys = "INSERT INTO person_keys  (person_id, key_id, deposit_paid, deposit_date) 
								VALUES (1, " . $keyId . ", 0, NULL)";
		$result_reinsert_keys = pg_query($connect, $query_reinsert_keys);
	}
	
?>
