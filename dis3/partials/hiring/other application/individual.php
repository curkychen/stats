<html>
<head></head>
<body>
	<?php 
	include 'inc/db.inc.php';
	$connect=mysqli_connect($server, $user, $password, $database) or die ("Unable to connect to server!");
	$ln=$_GET['id'];
	$query="SELECT * FROM applicants";
	$result=mysqli_query($connect,$query) or die("Error in query:$query.".mysqli_error()); 
	if(mysqli_num_rows($result)>0){
		while($tab=mysqli_fetch_assoc($result)){
		$id=$tab['applicant_id'];
		$last=$tab['last_name'];
		$first=$tab['first_name'];
		$date=$tab['date_submitted'];
		$ack=$tab['acknowledged'];
			$ack = ($ack=='0' ? 'no' : 'yes');
		$res=$tab['cv'];
			$res = ($res=='0' ? 'no' : 'yes');
		$teach=$tab['teaching_statement'];
			$teach = ($teach=='0' ? 'no' : 'yes');
		$trans=$tab['transcript'];
			$trans = ($trans=='0' ? 'no' : 'yes');
		$let1=$tab['letter_one'];
			$let1 = ($let1=='0' ? 'no' : 'yes');
		$let2=$tab['letter_two'];
			$let2 = ($let2=='0' ? 'no' : 'yes');
		$let3=$tab['letter_three'];
			$let3 = ($let3=='0' ? 'no' : 'yes');
	if($ln==$id){
		break;
		}
	}
	echo "<i>$last</i><br>";
	echo "<i>$first</i><br>";
	echo "<i>$date</i><br>";
	echo "Acknowledged: <i>$ack</i><br>";
	echo "CV: <i>$res</i><br>";
	echo "Teaching Statement: <i>$teach</i><br>";
	echo "Transcript: <i>$trans</i><br>";
	echo "Letter 1: <i>$let1</i><br>";
	echo "Letter 2:<i>$let2</i><br>";
	echo "Letter 3: <i>$let3</i><br>";
	$cv=glob($id . "/cv_*");
	$st=glob($id . "/statement_*");
	$script=glob($id . "/transcript_*");
	$l1=glob($id . "/let1_*");
	$l2=glob($id . "let2_*");
	$l3=glob($id . "let3_*");
	if(is_array($cv) && count($cv)>0) {
		foreach($cv as $filename) {
			echo "<a href=" . $filename . ">" . $filename . "</a><br />";
		}
	}else{	
		echo '<a href="uploads.php?id=' . $id . '&type=cv">Upload CV</a><br>';
	}
	if(is_array($st) && count($st)>0) {
		foreach($st as $filename) {
			echo "<a href=" . $filename . ">" . $filename . "</a><br />";
		}
	}else{	
		echo '<a href="uploads.php?id=' . $id . '&type=ts">Upload Teaching Statement</a><br>';
		}
	if(is_array($script) && count($script)>0) {
		foreach($script as $filename) {
			echo "<a href=" . $filename . ">" . $filename . "</a><br />";
			}
	}else{	
		echo '<a href="uploads.php?id=' . $id . '&type=script">Upload Transcript</a><br>';
		}
	if(is_array($l1) && count($l1)>0) {
		foreach($l1 as $filename) {
			echo "<a href=" . $filename . ">" . $filename . "</a><br />";
		}
	}else{	
		echo '<a href="uploads.php?id=' . $id . '&type=let1">Upload Letter 1</a><br>';
		}
	if(is_array($l2) && count($l2)>0) {
		foreach($l2 as $filename) {
			echo "<a href=" . $filename . ">" . $filename . "</a><br />";
		}
	}
	else{	
		echo '<a href="uploads.php?id=' . $id . '&type=let2">Upload Letter 2</a><br>';
	}
	if(is_array($l3) && count($l3)>0) {
		foreach($l3 as $filename) {
			echo "<a href=" . $filename . ">" . $filename . "</a><br />";
		}
	}else{	
		echo '<a href="uploads.php?id=' . $id . '&type=let3">Upload Letter 3</a><br>';
		}
	}
	?>
</body>
</html>