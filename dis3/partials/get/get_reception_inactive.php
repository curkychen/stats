<?php 
include ('inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

/* sort by the semester, but semester not alphabetical. Sorting by start_date for simplicity. */
$query="SELECT * from images WHERE active = '0'";
$result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));

#nullcheck
$numrows = pg_num_rows($result);
$i = 0;
	while ($i < $numrows){
		$row = pg_fetch_array($result);
		$filename = $row['fileName'];
		$pos = $row['position'];


		$data[$i][]=$filename;
		$data[$i][]=$pos;

	$i++;
}

$temp = " [ ";
if(isset($data)){
	foreach($data as $line){
		$temp .= '{
			"name": "' . $line[0] . '",
			"position": "' . $line[1] . '"},';
		}
	
	$temp=substr($temp, 0, -1);
	$temp .= " ]";

	echo $temp;
}


?>
