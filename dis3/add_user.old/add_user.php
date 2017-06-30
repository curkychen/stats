<html>
<head>
<title>Add User</title>
<?php
	include('inc/db.php');
	$connect=mysqli_connect($server, $user, $password, $database) or die ("Unable to connect to server!");
	$query = "SELECT * FROM `users`";
	$result = mysqli_query($connect, $query) or die("Error in Query:$query." . mysqli_error());
		
	
?>
<link rel="stylesheet" type="text/css" href="schedule.css" />
<link rel="stylesheet" type="text/css" href="960_12_col.css" />
</head>
<body>
<div class="container_12">
	<div class="grid_12 push_4">
		<h2>Add User</h2>
	</div>
	<div class="grid_12 push_4">
		
		<form action="add_new_user.php" method="post">
			First Name:<input type="text" name="first_name" /> <br>
			Last Name:<input type="text" name="last_name" /> <br>
			Preferred Email Address:<input type="text" name="email" /> <br>
			Andrew ID:<input type="text" name="user_id" />@andrew.cmu.edu <br>
			Password:<input type="password" name="password" /> <br>
					<?php
						$query='SELECT * FROM users';
						$result=mysqli_query($connect, $query) or die ("Error in query:$query.".mysqli_error($connect));
						if(mysqli_num_rows($result)>0){
							while($row=mysqli_fetch_assoc($result)){	
								$color[]=$row['color_value'];
							}
						}
						$randomcolor="";
						while($randomcolor = strtoupper(dechex(rand(0,10000000)))){
							$color_value = array_search($random_color, $color, $strict = true);

							 if($color_value === false){
								break;
							}
						}	
					?>
			Course(s):<select name="course_selection">
					<?php 
						$course_query="SELECT * FROM class_list";
						$course_result=mysqli_query($connect, $course_query) or die ("Error in query:$course_query.".mysqli_error($connect));
						if(mysqli_num_rows($course_result)>0){
							while($row=mysqli_fetch_assoc($course_result)){
							$course_number=$row['course_number'];
							$course_id=$row['id'];
							echo '<option value="' . $course_id . '">' . $course_number . '</option>';
							}
						}	
					?>
						</select> 
						<!--and
						<select name="course_selection">
							
					<?php 
						
						$course_query="SELECT * FROM class_list";
						$course_result=mysqli_query($connect, $course_query) or die ("Error in query:$course_query.".mysqli_error($connect));
						if(mysqli_num_rows($course_result)>0){
						
							while($row=mysqli_fetch_assoc($course_result)){
							$course_number=$row['course_number'];
							$course_id=$row['id'];
							echo '<option value="' . $course_id . '">' . $course_number . '</option>';
							}
						}	
					?>
						</select>-->
						<br>
			Picture: <input type="file" name="file"/><br />
			<input type="hidden" value="<?php echo $randomcolor; ?>" name="color_value" /> <br>
			<input type="submit" value="Add User" />
		</form>
	</div>
</div>
</body>
</html>