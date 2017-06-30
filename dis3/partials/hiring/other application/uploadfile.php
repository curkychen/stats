<?php
include 'inc/db.inc.php';
$connect=mysqli_connect($server, $user, $password, $database) or die ("Unable to connect to server!");
$upload=$_GET['res'];
$type=$_GET['type'];
$extAllowed=array("doc", "docx", "pdf", "txt");
$temp=explode(".", $_FILES["file"]["name"]);
$extension=end($temp);
if(in_array($extension, $extAllowed)){
	if($_FILES["file"]["error"]>0){
		echo "Return Code:" . $_FILES["file"]["error"] . "<br>";
	} else {
		switch($type){
			case "cv":
				if(file_exists($upload)){
					if(file_exists($upload . '/cv_' . $_FILES["file"]["name"])){
						echo $upload . '/cv_' . $_FILES["file"]["name"] . "<br>already exists. ";
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/cv_' . $_FILES["file"]["name"]);
						echo "Stored in:<br>" . $upload . '/cv_' . $_FILES["file"]["name"];
						//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
					}
				} else {
					mkdir($upload, 0777);
					move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/cv_' . $_FILES["file"]["name"]);
					echo "Stored in:<br>" . $upload . '/cv_' . $_FILES["file"]["name"];
					//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
				}
				$uploadedfile='cv_' . $_FILES["file"]["name"];
				$query="UPDATE `applicants` SET `cv_document`='" . $uploadedfile . "' WHERE `applicant_id`=" . $upload;
				$result=mysqli_query($connect,$query);
				break;
			case "ts":
				if(file_exists($upload)){
					if(file_exists($upload . '/statement_' . $_FILES["file"]["name"])){
						echo $upload . '/statement_' . $_FILES["file"]["name"] . "<br>already exists. ";
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/statement_' . $_FILES["file"]["name"]);
						echo "Stored in:<br>" . $upload . '/statement_' . $_FILES["file"]["name"];
						//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
					}
				} else {
					mkdir($upload, 0777);
					move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/statement_' . $_FILES["file"]["name"]);
					echo "Stored in:<br>" . $upload . '/statement_' . $_FILES["file"]["name"];
					//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
				}
				$uploadedfile='statement_' . $_FILES["file"]["name"];
				$query="UPDATE `applicants` SET `teaching_statement`='" . $uploadedfile . "' WHERE `applicant_id`=" . $upload;
				$result=mysqli_query($connect,$query);
				break;
			case "script":
				if(file_exists($upload)){
					if(file_exists($upload . '/transcript_' . $_FILES["file"]["name"])){
						echo $upload . '/transcript_' . $_FILES["file"]["name"] . "<br>already exists. ";
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/transcript_' . $_FILES["file"]["name"]);
						echo "Stored in:<br>" . $upload . '/transcript_' . $_FILES["file"]["name"];
						//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
					}
				} else {
					mkdir($upload, 0777);
					move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/transcript_' . $_FILES["file"]["name"]);
					echo "Stored in:<br>" . $upload . '/transcript_' . $_FILES["file"]["name"];
					//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
				}
				$uploadedfile='transcript_' . $_FILES["file"]["name"];
				$query="UPDATE `applicants` SET `transcript`='" . $uploadedfile . "' WHERE `applicant_id`=" . $upload;
				$result=mysqli_query($connect,$query);
				break;
			case "let1":
				if(file_exists($upload)){
					if(file_exists($upload . '/let1_' . $_FILES["file"]["name"])){
						echo $upload . '/let1_' . $_FILES["file"]["name"] . "<br>already exists. ";
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/let1_' . $_FILES["file"]["name"]);
						echo "Stored in:<br>" . $upload . '/let1_' . $_FILES["file"]["name"];
						//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
					}
				} else {
					mkdir($upload, 0777);
					move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/let1_' . $_FILES["file"]["name"]);
					echo "Stored in:<br>" . $upload . '/let1_' . $_FILES["file"]["name"];
					//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
				}
				$uploadedfile='let1_' . $_FILES["file"]["name"];
				$query="UPDATE `applicants` SET `letter_one`='" . $uploadedfile . "' WHERE `applicant_id`=" . $upload;
				$result=mysqli_query($connect,$query);
				break;
			case "let2":
				if(file_exists($upload)){
					if(file_exists($upload . '/let2_' . $_FILES["file"]["name"])){
						echo $upload . '/let2_' . $_FILES["file"]["name"] . "<br>already exists. ";
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/let2_' . $_FILES["file"]["name"]);
						echo "Stored in:<br>" . $upload . '/let2_' . $_FILES["file"]["name"];
						//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
					}
				} else {
					mkdir($upload, 0777);
					move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/let2_' . $_FILES["file"]["name"]);
					echo "Stored in:<br>" . $upload . '/let2_' . $_FILES["file"]["name"];
					//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
				}
				$uploadedfile='let2_' . $_FILES["file"]["name"];
				$query="UPDATE `applicants` SET `letter_two`='" . $uploadedfile . "' WHERE `applicant_id`=" . $upload;
				$result=mysqli_query($connect,$query);
				break;
			case "let3":
				if(file_exists($upload)){
					if(file_exists($upload . '/let3_' . $_FILES["file"]["name"])){
						echo $upload . '/let3_' . $_FILES["file"]["name"] . "<br>already exists. ";
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/let3_' . $_FILES["file"]["name"]);
						echo "Stored in:<br>" . $upload . '/let3_' . $_FILES["file"]["name"];
						//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
					}
				} else {
					mkdir($upload, 0777);
					move_uploaded_file($_FILES["file"]["tmp_name"], $upload . '/let3_' . $_FILES["file"]["name"]);
					echo "Stored in:<br>" . $upload . '/let3_' . $_FILES["file"]["name"];
					//header("Location:http://www.stat.cmu.edu/~zgreen/individual.php");
				}
				$uploadedfile='let3_' . $_FILES["file"]["name"];
				$query="UPDATE `applicants` SET `letter_three`='" . $uploadedfile . "' WHERE `applicant_id`=" . $upload;
				$result=mysqli_query($connect,$query);
				break;
		}
	}
} else {
	echo "Invalid File";
}
?>	