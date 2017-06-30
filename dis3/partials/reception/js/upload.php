<?php
/**
 * Created by PhpStorm.
 * User: general
 * Date: 6/23/17
 * Time: 10:13 AM
 */
include('../../get/inc/db.php');
$connect=pg_connect("host=$hostname dbname=$database user=$user password=$password");


if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ "file" ][ "tmp_name" ];
//    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    $uploadDir = '/var/www/html/dis/uploads/reception/';
    $time = date("Y-m-d-H-i-s");
    if(basename($_FILES["file"]["tmp_name"]!=null&&basename($_FILES["file"]["name"])!=""))
    {
        $fileName = $time . "_" . basename($_FILES["file"]["name"]);
    }
    $uploadFile = $uploadDir.$fileName;
    if (move_uploaded_file( $tempPath, $uploadFile )){
        echo 'success!';
        //    $query="INSERT INTO images SET active='1' WHERE \"fileName\" LIKE '$name'";
        $defualtPosition = -1;
        // $defualtActive = "'0'";
        // $ImageID = hexdec(uniqid());
        $ImageID = rand(100000,999999);
        $query="INSERT INTO images(\"fileName\",\"position\",active,\"imageID\") VALUES('$fileName', $defualtPosition,'0', $ImageID)";
//    INSERT INTO images("fileName","position",active,"imageID") VALUES('hhhh.jpg', -1, '0',1)
        echo $query;
        $result=pg_query($connect, $query) or die ("Error in Query:$query.".pg_last_error($connect));
        // echo $result;
        // if ($result === false) {
        //     echo pg_last_error($connect);
        // } else {
        //     echo 'everything was ok';
        //     }
        // or die ("Error in Query:$query.".pg_last_error($connect));
//        $answer = array( 'answer' => 'File transfer completed' );
//        $json = json_encode( $answer );

//        echo $json;
    } else {
        echo 'fail!';
    }


} else {

    echo 'No files';

}
?>