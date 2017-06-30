<?php

function writetofile($applicant){
include 'inc/db.inc.php';
$connect=mysqli_connect($server, $user, $password, $database) or die ("Unable to connect to server!");
$lastname=$applicant['lastname']; 
$firstname=$applicant['firstname'];
$date=$applicant['date']; 
$ack=$applicant['ack']; 
	if($ack==''){
	$ack="0";
		}
	else{
	$ack="1";
	}
$cv=$applicant['cv']; 
	if($cv==''){ 
	$cv="0";
		}
	else{
	$cv="1";
	}
$ts=$applicant['ts']; 
	if($ts==''){ 
	$ts="0";
		}
	else{
	$ts="1";
	}
$transcripts=$applicant['transcripts']; 
	if($transcripts==''){
	$transcripts="0";
		}
	else{
	$transcripts="1";
	}
$l1=$applicant['l1']; 
	if($l1==''){ 
	$l1="0";
		}
	else{
	$l1="1";
	}
$l2=$applicant['l2']; 
	if($l2==''){ 
	$l2="0";
		}
	else{
	$l3="1";
	}
$l3=$applicant['l3']; 
	if($l3==''){ 
	$l3="0";
		}
	else{
	$l3="1";
	}
	/*$file='work/applicants.csv' or die('Could not find file');
	$var=$id . ',' . $lastname . ',' . $firstname . ',' . $date . ',' . $ack . ',' .$cv . ',' . $ts . ',' . $transcripts . ',' . $l1 . ',' . $l2 . ',' . $l3 . "\n"; 
	$fh=fopen($file, 'a')or die('Could not open file!');
	$lines = file($file);
	for($lineexist=0, $i=0; $i>count($lines); $i++) {
		if($var==$lines[$i]){ 
		$lineexist=1;
			}
		}	
	if($lineexist==0){ 
	fwrite($fh, "$var")or die('Could not write to
	file'); 
	*/
	$lastname=empty($_POST['lastname']) ? die("ERROR: Enter Last Name"):  mysqli_escape_string($_POST['lastname']);
	$firstname=empty($_POST['firstname']) ? die("ERROR: Enter First Name"):  mysqli_escape_string($_POST['firstname']);
	$date=empty($_POST['date']) ? die("ERROR: Enter Date"):  mysqli_escape_string($_POST['date']);
	mysqli_select_db($connect,$database) or die ("Unable to select database!");
	$query="INSERT INTO `applicants` (`applicant_id` ,  `last_name` ,  `first_name` ,  `date_submitted` ,  `acknowledged` ,  `cv` , `teaching_statement` ,  `transcript` ,  `letter_one` ,  `letter_two` ,  `letter_three` ) VALUES (NULL, '" . $lastname . "', '" . $firstname . "', '" . $date . "', '" . $ack . "', '" . $cv . "', '" . $ts . "', '" . $transcripts . "', '" . $l1 . "', '" . $l2 . "', '" . $l3 . "')";	
	$result=mysqli_query($connect,$query) or die ("Error in query: $query. ".mysqli_error($connect));
}	
	?>