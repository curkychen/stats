<?php
include ('writetofile.php'); 
include ('inc/db.inc.php');
$connect=mysqli_connect($server, $user, $password, $database) or die ("Unable to connect to server!");
$applicant['lastname']=empty($_POST['lastname']) ? die("ERROR: Enter Last Name"):  mysqli_escape_string($_POST['lastname']);
$applicant['firstname']=empty($_POST['firstname']) ? die("ERROR: Enter First Name"):  mysqli_escape_string($_POST['firstname']);
$applicant['date']=empty($_POST['date']) ? die("ERROR: Enter Date"):  mysqli_escape_string($_POST['date']);
$applicant['ack']=$_POST['ack'];
$applicant['cv']=$_POST['cv'];
$applicant['ts']=$_POST['ts'];
$applicant['transcripts']=$_POST['transcripts'];
$applicant['l1']=$_POST['l1'];
$applicant['l2']=$_POST['l2'];
$applicant['l3']=$_POST['l3'];
writetofile($applicant);
?>
