<?php 
include ('inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$query="SELECT * FROM relationships";
$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));

$i=0;
if(pg_num_rows($result)>0){
	while($row=pg_fetch_array($result)){
		$relId=$row['id'];
		$rel = $row['relationship'];
		$data[$i][]=$relId;
		$data[$i][]=$rel;
		$i++;
		}
	}
$temprel=" [ ";
if(isset($data)){
	foreach($data as $line){
		$temprel .= '{
			"id": "' . $line[0] . '",
			"relationship": "' . $line[1] . '"},';
		}
	$rel=substr($temprel, 0, -1);
	$rel.= " ]";
	echo $rel;
	}
?>