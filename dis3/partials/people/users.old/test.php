<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Papermashup.com | JQuery Drag and Drop Demo</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
<style>
ul {
	padding:0px;
	margin: 0px;
}
#response {
	padding:10px;
	background-color:#9F9;
	border:2px solid #396;
	margin-bottom:20px;
}
#list li {
	margin: 0 0 3px;
	padding:8px;
	background-color:#333;
	color:#fff;
	list-style: none;
}
</style>
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
</script>
</head>
<body>
<div id="container">
  <div id="list">

    <div id="response"> </div>
    <ul>
      <?php
                include("connect.php");

				$query  = "SELECT imageID, fileName, position FROM images where active = 1 ORDER BY position ASC";
				$result = mysqli_query($conn, $query);
				$num_rows = mysqli_num_rows($result);
				$counter =0;
				while($row = $result->fetch_assoc())
				{
					$counter++;
				$id = stripslashes($row['imageID']);
				echo $position;
				$position = stripslashes($row['position']);
				$fileurl = stripslashes($row['fileName']);
				
				$imageName="/home/www/reception/uploads/".$fileurl;
	//echo $images[$i]['fileName']."<br>";
				$image = new Imagick($imageName);
				$image->thumbnailImage(200,0);
	//header('Content-Type: image/png');
	//echo $image;
	$image->writeImage("/home/www/reception/thumbnails/thumbnail_".$fileurl);


				$text = stripslashes($row['fileName']);
					
				?>
      <li id="arrayorder_<?php echo $id ?> "><?php echo "imageID ".$id?><?php echo "<td id = \"picTableCell\">".$fileurl."</td>"?> <?php echo " Position".$position?><?php echo "<td id = \"picTableCell\"> <img src=\"/reception/thumbnails/thumbnail_".$fileurl."\"></td>"; ?>
        <div class="clear"></div>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<div id="footer"><a href="http://www.papermashup.com">papermashup.com</a> | <a href="http://papermashup.com/drag-drop-with-php-jquery/">Back to tutorial</a></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7025232-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
