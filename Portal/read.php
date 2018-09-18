<?php
include_once("check.php");

header("Content-Type:application/json");
//include_once("db_connect.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myerdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!empty($_GET['name'])) {
$name=$_GET['name'];
$items = getItems($name, $conn);
if(empty($items)) {
jsonResponse(200,"Items Not Found",NULL);
} else {
jsonResponse(200,"Item Found",$items);
}
} else {
jsonResponse(400,"Invalid Request",NULL);
}
function jsonResponse($status,$status_message,$data) {
    header("HTTP/1.1 200 OK");
    
    //header("HTTP/1.1 ".$status_message);
$response['status']=$status;
$response['status_message']=$status_message;
$response['data']=$data;
$json_response = json_encode($response);
echo $json_response;
}
function getItems($name, $conn) {
 $sql = "SELECT ID,UserId FROM userauthentication p WHERE p.ID LIKE '%".$name."%'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn)); 
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$data[] = $rows;
}
return $data;
}
?>