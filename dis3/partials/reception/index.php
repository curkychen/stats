<html>
<head>
<!-- <link rel="stylesheet" type="text/css" href="guiStyles.css"> -->
<script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script></head>
      <link type="text/css" rel="stylesheet" href="materialize.min.css"  media="screen,projection"/>

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


<script>
 $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
        
        </script>

<div class = "container">
	<div class = "card">
<h2>Current Display Information </h2>
<h3>Images in Circulation</h3>



<table class = "bordered striped">
	<thead>
		<tr>
           <th data-field="id">Position in Rotation</th>
           <th data-field="id">Image Thumbnail</th>
           <th data-field="id">File Name</th>



<?php
//$dbhost = 'localhost';
//$dbuser = 'reception';
//$dbpass = 'UMdx8H92nfAawtFh';
$dbhost = 'cetus.stat.cmu.edu';
$dbuser = 'dis';
$dbpass = 'JwT';
//$conn = mysqli_connect($dbhost,$dbuser,$dbpass,'dis');
$conn=pg_connect("host=$dbhost dbname=$dbuser user=$dbuser password=$dbpass") or die('connection failed');
//if(!$conn)
//{
//die('failed to connect: ' . mysqli_error());
//}
$true = 1;
$false = 0;
$sql = "SELECT fileName, position FROM images WHERE active=".$true." ORDER BY position";
//echo $sql."<br>";
$retval = mysqli_query($conn,$sql);
//print_r(mysqli_num_rows($retval));
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

/*function compare($array1,$array2)
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
}*/
//usort($images,"compare");
for($i = 0; $i<count($images); $i++)
{	
	
	echo"<tr>";
	echo"<td id=\"picTableCell\">".$images[$i]['position']."</td>";
	try{
	$imageName="/home/www2014/reception/uploads/".$images[$i]['fileName'];
	//echo $images[$i]['fileName']."<br>";
	
	
	echo("<td id = \"picTableCell\"> <img class =\"materialboxed\" width=\"300\" src=\"/reception/uploads/".$images[$i]['fileName']."\"></td>");
	echo("<td id = \"picTableCell\">".$images[$i]['fileName']."</td>");
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	echo"</tr>";
}
?>
</div>
</div>

<table class = "bordered striped">
	<thead>
		<tr>
           <th data-field="id">Position in Rotation</th>
           <th data-field="id">Image Thumbnail</th>
           <th data-field="id">File Name</th>




<?php
$sql = "SELECT fileName, position FROM images WHERE active=".$false." ORDER BY position";
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

for($i = 0; $i<count($images); $i++)
{	
	
	echo"<tr>";
	echo"<td id=\"picTableCell\">".$images[$i]['position']."</td>";
	try{
	$imageName="/home/www2014/reception/uploads/".$images[$i]['fileName'];

	//echo $images[$i]['fileName']."<br>";
	
	
	echo("<td id = \"picTableCell\"> <img class =\"materialboxed\" width=\"300\" src=\"/reception/uploads/".$images[$i]['fileName']."\"></td>");
	echo("<td id = \"picTableCell\">".$images[$i]['fileName']."</td>");
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	echo"</tr>";
}




?>

<div id = "paragraphs">
<br><h4>Inactive Images</h4></div>
<div>
</table>
<div id = "paragraphs">
<br><h3>Scroll Bar Announcements in Circulation</h3>
</div>
<table id="picTable">
<tr>
<td id="picTableHead">Position in Rotation</td><td id = "picTableHead">Announcement Text</td>
</tr>

<?php
//$dbhost = 'localhost';
//$dbuser = 'reception';
//$dbpass = 'UMdx8H92nfAawtFh';
$dbhost = 'cetus.stat.cmu.edu';
$dbuser = 'dis';
$dbpass = 'JwT';
//$conn = mysqli_connect($dbhost,$dbuser,$dbpass,'dis');
//if(! $conn)
//{
//die('failed to connect: ' . mysqli_error());
//}
$conn=pg_connect("host=$dbhost dbname=$dbuser user=$dbuser password=$dbpass") or die('connection failed');
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
	
	echo"</tr>";
}

?>

</table>
</div>
</div>
</body>
</html>
