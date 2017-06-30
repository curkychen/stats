<?php
echo "enter the add user with image";
include '../get/inc/db.php';

$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");


echo "enter the empty add the image";
if ( !empty( $_FILES ) ) {
    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    echo "tempPath is ".$tempPath;
    $uploadDir = '/var/www/html/dis/uploads/people/';
    $time = date("Y-m-d-H-i");
    if(basename($_FILES["file"]["tmp_name"]!=null&&basename($_FILES["file"]["name"])!=""))
    {
        $uploadPath = $uploadDir . $time . "_" . basename($_FILES["file"]["name"]);
    }
//    $uploadPath = $uploadDir . $_FILES[ 'file' ][ 'name' ];
    echo "move to file ".$uploadPath;
    if (move_uploaded_file( $tempPath, $uploadPath )){
        echo "move_upload file success!";
    } else {
        echo "fail!";
    }
    $answer = array( 'answer' => 'File transfer completed' );
    $json = json_encode( $answer );
    echo $json;
} else {
    echo 'No files';
}

/**
 * Created by PhpStorm.
 * User: general
 * Date: 6/29/17
 * Time: 2:12 PM
 */
?>