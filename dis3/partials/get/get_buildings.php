<?php 

	include ('inc/db.php');
	$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");
	
	$bldg_query="SELECT * FROM building";
	$bldg_result=pg_query($connect, $bldg_query) or die ("Error in query:$course_query.".pg_last_error($connect));
	$i=0;
	if(pg_num_rows($bldg_result)>0){
		while($row=pg_fetch_assoc($bldg_result)){
			$name=$row['building_name'];
			$id=$row['building_id'];
			
			$db[$i][] = $name;
			$db[$i][] = $id;
			$i++;
		}
	}	

	$temp=" [ ";
		if(isset($db)){
			foreach($db as $line){
				$temp .= '{
					"bName": "' . $line[0] . '",
					"bId": "' . $line[1] . '" },';
			}
			$bldg=substr($temp, 0, -1);
			$bldg.= " ]";
			echo $bldg;
		}

?>