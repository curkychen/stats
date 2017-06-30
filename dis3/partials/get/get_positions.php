<?php 
	include ('inc/db.php');
	$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
	
	
	$query_get_pos="SELECT * FROM position";
	$i = 0;
	$pos_result=pg_query($connect, $query_get_pos) or die("Error in query:$query_get_room.".pg_last_error($connect));
	if(pg_num_rows($pos_result)>0){
		while($row=pg_fetch_assoc($pos_result)){
			$id=$row['id'];
			$position=$row['position_name'];
			$data[$i][]=$id;
			$data[$i][]=$position;
			$i++;
		}
	}
	
	$temp=" [ ";
	if(isset($data)){
		foreach($data as $line){
			$temp .= '{
				"positionID": "' . $line[0] . '",
				"position": "' . $line[1] . '" },';
		}
		$newPos=substr($temp, 0, -1);
		$newPos.= " ]";
		echo $newPos;
	}
?>