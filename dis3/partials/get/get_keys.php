<?php

include('inc/db.php');

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
$data="SELECT * FROM keys";
$result=pg_query($connect, $data) or die ("Error in query:$data.".pg_last_error($connect));
$i=0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		
		$key_number=$row['key_ident_str'];
		$key_id = $row['key_id'];
		$db[$i][]=$key_number;
		$db[$i][]=$key_id;
		$i++;
	}
}		
$tempkey="[ ";
if(isset($db)){
	foreach($db as $line){
		//echo $line[0];	
		$tempkey.= '{ 
		"keyNumber": "' . $line[0] . '",
		"keyId": "' . $line[1] . '"},';
	}
	$key = substr($tempkey, 0, -1);
	$key .= ']';
	echo $key;
}

?>