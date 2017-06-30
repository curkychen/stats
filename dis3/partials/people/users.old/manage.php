<html>
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="materialize.min.css">
<link rel="stylesheet" type="text/css" href="guiStyles.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
<nav>
<div class="nav-wrapper teal lighten-3">
  <a href="#" class="brand-logo">Statistics</a>
  <ul id="nav-mobile" class="right hide-on-med-and-down">
<li><a href="http://www.stat.cmu.edu/reception/admin/index.php">Home</a></li>
<li><a href="http://www.stat.cmu.edu/reception/admin/manage.php">Manage Images</a></li>
 <li><a href="http://www.stat.cmu.edu/reception/admin/design.php">Design Slides</a></li>
  </ul>
</div>
</nav>



<script type="text/javascript">
$(document).ready(function(){
	  function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });

}, 2000);}

    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {

			var order = $(this).sortable("serialize") + '&update=update';
			$.post("updateList.php", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			});
		}
		});
	});

});


//can't reconcile version of jquery with the dragging so just going to use this ...


function remove(name){

	$.ajax({
        url: "http://www.stat.cmu.edu/reception/admin/delete.php",
        type: "post",
        dataType: 'html',
       data: {'name':name,
        	},
        success: function (response) {
                        console.log(name);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

	$( ".removeAlert" ).append( "<p>Deleted image!</p>" );
}

function removeAnnouncement(name){
$.ajax({
        url: "http://www.stat.cmu.edu/reception/admin/deleteAnnouncement.php",
        type: "post",
        dataType: 'html',
       data: {'name':name,
        	},
        success: function (response) {
                        console.log(name);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

	$( ".removeAlert" ).append( "<p>Deleted announcement!</p>" );
}

function check(name){

var checkstatus = true;


if (document.getElementById(name).value=="true"){
document.getElementById(name).value = "false";
console.log("check!");
checkstatus = 0;
}

else {
	document.getElementById(name).value="true";
	console.log("uncheck");
	checkstatus = 1;
}




 $.ajax({
        url: "http://www.stat.cmu.edu/reception/admin/checkactive.php",
        type: "post",
        dataType: 'html',
        data: {'name':name,
        		'checkstatus': checkstatus
        	},
        success: function (response) {
                        console.log(name);
                        console.log(checkstatus);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

}



</script>

<div class = "container">
<div id="top">
<h2>Edit Display Content</h2>
</div>

<div id="formDiv">
<form name="imageForm" method="POST" onsubmit="return true" enctype="multipart/form-data">
<table class="highlight">
<tr>
<td></td>
</tr>
<h4>Add a file</h4>
Upload image that you would like to add:<br><br>
<input type="file" name="fileToUpload" id="fileToUpload"><br>
<!-- New slide's position in rotation: <input type="text" name="uploadPosition"><br> -->
<?php
$dbhost = 'localhost';
$dbuser = 'reception';
$dbpass = 'UMdx8H92nfAawtFh';
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,'receptionImages');
if(! $conn)
{
die('failed to connect: ' . mysqli_error($conn));
}
$true = 1;
$sql = "SELECT fileName, position FROM images WHERE active=" .$true;


$retval = mysqli_query($conn,$sql);

if(! $retval)
{
	die("failed to retrieve data: " .mysqli_error($conn));
}
$images = array();
$counter = 0;
while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
{
	$images[$counter] = $row;
	$counter = $counter + 1;
}

function compare($array1,$array2)
{
	if($array1['position']<$array2['position'])
	{
		return -1;
	}
	else if($array2['position']<$array1['position'])
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
usort($images,"compare");

echo"<select name=\"fileToDelete\">";
echo"<option value=\"none\"></option>";
for($i=0; $i<count($images); $i++)
{
	echo"<option value=\"".$images[$i]['fileName']."\">".$images[$i]['fileName']."</option>";
}
echo"</select><br><br>";

$false=0;
$sql2 = "SELECT fileName, position FROM images WHERE active=".$false;
//echo $sql."<br>";
$retval2 = mysqli_query($conn,$sql2);
//print_r(mysqli_num_rows($retval));
if(! $retval2)
{
	die("failed to retrieve data: " .mysqli_error($conn));
}
$images2 = array();
$counter = 0;
while($row = mysqli_fetch_array($retval2, MYSQL_ASSOC))
{
	$images2[$counter] = $row;
	$counter = $counter + 1;
}
echo"<h4>Reactivate or delete a file</h4>";
// echo"<table>";
// echo"<thead>";
// echo"<tr>";

// echo "<th>File Name</th>";
// echo "<th>Active?</th>";
// echo"</thead>";

$connect = mysqli_connect("localhost","reception","UMdx8H92nfAawtFh","receptionImages") or die(mysqli_error($conn));

echo"<tbody>";
echo"<tr>";
	echo"<th>File name</th>";
	echo"<th>Check active</th>";
	echo"<th>Delete</th>";
	echo"</tr>";
for($i=0; $i<count($images); $i++)
{


	echo"<tr>";

	$idName = $images[$i]['fileName'];
	echo "<td>".$images[$i]['fileName']."</td>";
	echo"<td>";
	echo"<input type = \"checkbox\" onclick = 'check(\"$idName\");' name = \"isChecked[]\" value =\"true\" checked =\"checked\" id = \"".$images[$i]['fileName']."\" />";

	echo '<label for="'.$images[$i]['fileName'].'"></label>';
	echo"<td>";

	echo "<a class = 'btn-floating' onclick = 'remove(\"$idName\");'><i class=\"small material-icons\"'>delete</i></button>";
	echo"</td>";

	echo "<div class = \"removeAlert\">";

	echo '</div>';


	echo"</td>";
	echo"</tr>";

}


for($i=0; $i<count($images2); $i++)
{
	echo"<tr>";

	$idName = $images2[$i]['fileName'];
	echo "<td>".$images2[$i]['fileName']."</td>";
	echo"<td>";
	echo"<input type = \"checkbox\" onclick = 'check(\"$idName\");' name = \"isChecked[]\" value =\"false\" id = \"".$images2[$i]['fileName']."\" />";

	echo '<label for="'.$images2[$i]['fileName'].'"></label>';
	echo"<td>";

	echo "<a class = 'btn-floating' onclick = 'remove(\"$idName\");'><i class=\"small material-icons\"'>delete</i></button>";
	echo"</td>";

	echo "<div class = \"removeAlert\">";

	echo '</div>';


	echo"</td>";
	echo"</tr>";




}
echo"</tbody>";


echo"</select><br><br>";

echo"</tr>";
echo"</table>";

echo"<div id = \"container\">";

echo"<div id = \"list\">";
echo"<div id = \"response\">";
echo"</div>";
echo"<ul>";

//draggable slide positions

include("connect.php");

	$query  = "SELECT imageID, fileName, position FROM images where active = 1 ORDER BY position ASC";
	$result = mysqli_query($conn, $query);
	$num_rows = mysqli_num_rows($result);
	$counter =0;
	while($row = $result->fetch_assoc())
	{
		$counter++;
	$id = stripslashes($row['imageID']);
	$position = stripslashes($row['position']);
	$next_position = $position+1;
	$fileurl = stripslashes($row['fileName']);

	$imageName="/home/www2014/reception/uploads/".$fileurl;
	$image = new Imagick($imageName);
	$image->thumbnailImage(200,0);

	$image->writeImage("/home/www2014/reception/thumbnails/thumbnail_".$fileurl);


				$text = stripslashes($row['fileName']);
				?>
   <li id="arrayorder_<?php echo $id ?> "><?php echo "<td id = \"picTableCell\">".$fileurl."</td>"?> <?php echo " Position".$position?><?php echo "<td id = \"picTableCell\"> <img src=\"/reception/thumbnails/thumbnail_".$fileurl."\"></td>"; ?>      <?php } ?>

  </div>
</div>
</div>

<div id = "paragraphs">
<br><h3>Scroll Bar Announcements in Circulation</h3>
</div>
<table id="picTable">
<tr>
<td id="picTableHead">Position in Rotation</td><td id = "picTableHead">Announcement Text</td>
</tr>

<?php
$dbhost = 'localhost';
$dbuser = 'reception';
$dbpass = 'UMdx8H92nfAawtFh';
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,'receptionImages');
if(! $conn)
{
die('failed to connect: ' . mysqli_error());
}
$true = 1;
$sql = "SELECT text, position FROM news WHERE active=".$true;
//echo $sql."<br>";
$retval = mysqli_query($conn,$sql);
//print_r(mysqli_num_rows($retval));
if(! $retval)
{
	die("failed to retrieve data: " .mysqli_error($conn));
}
$text = array();
$counter = 0;
while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
{
	$text[$counter] = $row;
	$counter = $counter + 1;
}


//usort($text,"compare");
for($i = 0; $i<count($text); $i++)
{

	echo"<tr>";
	echo"<td id=\"picTableCell\">".$text[$i]['position']."</td>";
	echo("<td id = \"picTableCell\">". $text[$i]['text']."</td>");
	$theText = $text[$i]['text'];
	echo "<td><a class = 'btn-floating' onclick = 'removeAnnouncement(\"$theText\");'><i class=\"small material-icons\"'>delete</i></button></td>";

	echo"</tr>";
}

?>
<table id="picTable">
<tr>
<td id = "picTableHead">Announcement management</td>
</tr>
<tr><td id = "picTableCell">
<h4>Add an announcement</h4>
Enter announcement text:<br>
<input type="text" name="announcementText" id="announcement"><br><br>
New announcement's position in rotation: <input type="text" name="announcementPosition"><br><br>
<!-- <h4>Remove an announcement</h4>
Select an announcement to deactivate:<br> -->
<?php
$dbhost = 'localhost';
$dbuser = 'reception';
$dbpass = 'UMdx8H92nfAawtFh';
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,'receptionImages');
if(! $conn)
{
die('failed to connect: ' . mysqli_error($conn));
}
$true = 1;
$sql = "SELECT text, position FROM news WHERE active=".$true;
//echo $sql."<br>";
$retval = mysqli_query($conn,$sql);
//print_r(mysqli_num_rows($retval));
if(! $retval)
{
	die("failed to retrieve data: " .mysqli_error($conn));
}
$text = array();
$counter = 0;
while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
{
	$text[$counter] = $row;
	$counter = $counter + 1;
}


usort($text,"compare");

echo"<select name=\"announcementToDelete\">";
echo"<option value=\"none\"></option>";
for($i=0; $i<count($text); $i++)
{
	echo"<option value=\"".$text[$i]['text']."\">".substr($text[$i]['text'],0,30)."</option>";
}
echo"</select><br><br>";

$false=0;
$sql2 = "SELECT text, position FROM news WHERE active=".$false;
//echo $sql."<br>";
$retval2 = mysqli_query($conn,$sql2);
//print_r(mysqli_num_rows($retval));
if(! $retval2)
{
	die("failed to retrieve data: " .mysqli_error($conn));
}
$text2 = array();
$counter = 0;
while($row = mysqli_fetch_array($retval2, MYSQL_ASSOC))
{
	$text2[$counter] = $row;
	$counter = $counter + 1;
}
// echo"<h4>Reactivate an announcement</h4>";
// echo"Announcement to reactivate: <br><select name=\"announcementToReactivate\">";
// echo"<input class = \"select-dropdown active\" type = \"text\">";
// for($i=0; $i<count($text2); $i++)
// {
// 	echo"<value=\"".$text2[$i]['text']."\">".substr($text2[$i]['text'],0,30)."</option>";
// }
// echo"</select><br><br>";


//EDIT ANNOUNCEMENT ORDER
// echo"<h4>Edit Announcement Order</h4>";
// for($i=0;$i<count($text);$i++)
// {
// 	echo substr($text[$i]['text'],0,30)." : <input type=\"text\" name=\"order".$text[$i]['text']. "\" value=\"".$text[$i]['position']."\"></input><br><br>";
// }


echo"</td></tr></table>";
echo"<input type=\"hidden\" name=\"formSubmitted\" value=\"1\"></input>";
echo"<input type=\"submit\" value=\"Submit\" id = \"submit\"></input>";
echo"</form>";
echo"</div>";


if($_POST["formSubmitted"]=="1")
{

$checkedList = $_POST["isChecked"];

foreach($checkedList as  &$value){
	echo $value;
}


$connect = mysqli_connect("localhost","reception","UMdx8H92nfAawtFh","receptionImages") or die(mysqli_error($conn));

$delete = $_POST["fileToDelete"];
$active = 0;
if($_POST["fileToDelete"]!="none")
{
	mysqli_query($connect,"UPDATE images SET active='$active' WHERE fileName='$delete'") or die(mysqli_error($conn));
}
$activate = $_POST["fileToReactivate"];
$active=1;
if($_POST["fileToReactivate"]!="none")
{
	mysqli_query($connect,"UPDATE images SET active='$active' WHERE fileName='$activate'") or die(mysqli_error($conn));
}
//echo "<br><pre>"; print_r($_POST); echo "</pre><br>";
for($i=0;$i<count($images);$i++)
{
	$position = $_POST["order". substr($images[$i]['fileName'],0,-4)."_png"];
//	echo $position . "<br />";
	$file = $images[$i]['fileName'];
	//echo "order". substr($images[$i]['fileName'],0,-4)."_png<br>";
	//echo $file.": ".$position."<br>";
	if($position!=null||$position!="")
	{
		mysqli_query($connect,"UPDATE images SET position='$position' WHERE fileName='$file'") or die(mysqli_error($conn));
	}
}




$delete = $_POST["announcementToDelete"];
$active = 0;
if($_POST["announcementToDelete"]!="none")
{
	mysqli_query($connect,"UPDATE news SET active='$active' WHERE text='$delete'") or die(mysqli_error($conn));
}
$activate = $_POST["announcementToReactivate"];
$active=1;
if($_POST["announcementToReactivate"]!="none")
{
	mysqli_query($connect,"UPDATE news SET active='$active' WHERE text='$activate'") or die(mysqli_error($conn));
}
//echo "<br><pre>"; print_r($_POST); echo "</pre><br>";
//print_r($_POST);
for($i=0;$i<count($text);$i++)
{

	//echo"<br>";
	//echo"order". str_replace(" ","_",$text[$i]['text'])."<br>";
	$position = $_POST["order". str_replace(" ","_",$text[$i]['text'])];
	//echo "position " . $position . "<br />";
	$file = $text[$i]['text'];
	//echo "order". substr($images[$i]['fileName'],0,-4)."_png<br>";
	//echo "file " . $file . "<br>";
	if($position!=null||$position!="")
	{
		//echo"in if <br>";
		mysqli_query($connect,"UPDATE news SET position='$position' WHERE text='$file'") or die(mysqli_error($conn));
	}
	//echo"here <br>";
}
if($_POST["announcementText"]!=null||$_POST["announcementText"]!="")
{
	$announcementText = $_POST["announcementText"];
	$announcementPosition = $_POST["announcementPosition"];
	$active = 1;

	mysqli_query($connect, "INSERT INTO news(text,position,active) VALUES('$announcementText','$announcementPosition','$active')") or die(mysqli_error($conn));

}

		header("Location: http://www.stat.cmu.edu/reception/admin/index.php");

echo"<div id=\"formDiv\">";
echo"data entry successful<br>";

$target_dir = "/home/www2014/reception/uploads/";
$fileName = null;
$time = date("Y-m-d-H-i-s");
//print_r($_FILES);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo "target file ".$target_file."<br>";
if(basename($_FILES["fileToUpload"]["name"]!=null&&basename($_FILES["fileToUpload"]["name"])!=""))
{
$fileName = $time . "_" . basename($_FILES["fileToUpload"]["name"]);
}
$fullName = $target_dir . $fileName;
$uploadOk = 1;
if(isset($_POST["submit"]))
{
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false)
	{
		echo "File is an image - ".$check["mine"] . ".";
		$uploadOk = 1;
	}else{
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

// $next_pos = $num_rows+1;

if(basename($target_file)==null||basename($target_file)=="")
{
	echo "You did not select a file to upload.<br>";
	$uploadOk = 0;
}
if($uploadOk == 0)
{
	echo "The image file was not uploaded successfully.<br>";
}else{

	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fullName))

	{
		$pos = $_POST['uploadPosition'];
		$active = 1;

		echo "The image " . basename($_FILES["fileToUpload"]["name"]). "has been uploaded.<br>";
		$pos = $_POST['uploadPosition'];
		mysqli_query($connect, "INSERT INTO images(fileName,position,active) VALUES('$fileName','$next_position','$active')") or die(mysqli_error($conn));
		echo "File successfully added to the listing.<br>";

		$goto = 'Location: http://www.stat.cmu.edu/reception/admin/index.php';
		$_POST = array();
		header($goto);


	}else{
		echo "There was an error uploading your image file.<br>";
	}
}

echo "Please refresh the page to enter new data.";
echo"</div>";
}


?>


</div>
</body>
</html>
