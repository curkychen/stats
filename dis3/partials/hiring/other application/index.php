<html>
<head></head>
<body>
<a href="partials/hiring/add_individual.php"><?php echo "Submission Form"; ?></a>
<table class="table">
	<tr class="row">
		<td>ID Number</td>
		<td>Last Name</td>
		<td>First Name</td>
		<td>Date Submitted</td>
		<td>Acknowledged</td>
		<td>CV</td>
		<td>Teaching Statement</td>
		<td>Transcript</td>
		<td>Letter 1</td>
		<td>Letter 2</td>
		<td>Letter 3</td>
	</tr>
<?php
//include 'write.php';
include 'inc/db.inc.php';
$connect=mysqli_connect($server, $user, $password, $database) or die ("Unable to connect to server!");
//if(isset($_POST)){
//writetofile($_POST);
//}
$query="SELECT * FROM applicants";
$result=mysqli_query($connect,$query) or die("Error in query:$query.".mysqli_error()); 
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_assoc($result)){
		$id=$row['applicant_id'];
		$last=$row['last_name'];
		$first=$row['first_name'];
		$date=$row['date_submitted'];
		$ack=$row['acknowledged'];
			$ack = ($ack=='0' ? 'no' : 'yes');
		$res=$row['cv'];
			$res = ($res=='0' ? 'no' : 'yes');
		$teach=$row['teaching_statement'];
			$teach = ($teach=='0' ? 'no' : 'yes');
		$trans=$row['transcript'];
			$trans = ($trans=='0' ? 'no' : 'yes');
		$let1=$row['letter_one'];
			$let1 = ($let1=='0' ? 'no' : 'yes');
		$let2=$row['letter_two'];
			$let2 = ($let2=='0' ? 'no' : 'yes');
		$let3=$row['letter_three'];
			$let3 = ($let3=='0' ? 'no' : 'yes');
		

?>
	
	<tr class="row">
		<td><a href="partials/hiring/individual.php?id=<?php echo $id; ?>"><?php echo $id; ?></a></td>
		<td><?php echo $last; ?></td>
		<td><?php echo $first; ?></td>	
		<td><?php echo $date; ?></td>
		<td><?php echo $ack; ?></td> 
		<td><?php echo $res; ?></td>
		<td><?php echo $teach; ?></td>
		<td><?php echo $trans; ?></td>
		<td><?php echo $let1; ?></td>
		<td><?php echo $let2; ?></td>
		<td><?php echo $let3; ?></td>
	</tr>
<?php
	}
}
else{
echo "No rows found!";
}
mysqli_free_result($result);
?>
</table>
</body>
<a href="partials/hiring/add_individual.php"><?php echo "Submission Form"; ?></a>
</html>