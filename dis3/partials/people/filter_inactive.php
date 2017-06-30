<?php
include '../get/inc/db.php';
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");

$postdata = file_get_contents("php://input");

$url = $_SERVER['REQUEST_URI'];

$show_inactive_query = "SELECT * FROM "

$add_rel_query = "INSERT INTO user_relationships (user_id_1, rel_type_id, rel_start, rel_end, user_id_2) VALUES (" . $user . ", " . $relationship .  ", '" . $start . "', '" . $end . "', " . $workedWith . ")";

$add_rel_result = pg_query($connect, $add_rel_query) or die ("Error in Query:$add_rel_query.".pg_last_error($connect));

?>
