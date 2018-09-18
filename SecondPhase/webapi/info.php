<?php
include_once("database.php");
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST"){
$request ='userdetails'; //explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'));

$id= $input->{'staffDetails'}->{"code"};

// connect to the mysql database
 
 // retrieve the table and key from the path
//$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
//$key = array_shift($request)+0;
 
 
// create SQL based on HTTP method
switch ($method) {
    
  case 'GET':
    $sql = "select 	EmployeeNo as code from userdetails  WHERE 	EmployeeNo='".$id."'"; break;
  case 'PUT':
    $sql = "update 	EmployeeNo set UserLogin =007 where 	EmployeeNo='".$id."'"; break;
  case 'POST':
    $sql = "select 	EmployeeNo as code from userdetails where 	EmployeeNo='".$id."'"; break;
  case 'DELETE':
    $sql = "delete 	EmployeeNo where 	EmployeeNo='".$id."'"; break;
}
 
// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}
 
// print results, insert id or affected row count
if ($method == 'GET') {
 // if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
 // if (!$key) echo ']';
} elseif ($method == 'POST') {
    for ($i=0;$i<mysqli_num_rows($result);$i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
      }
} else {
  echo mysqli_affected_rows($link);
}
 
// close mysql connection
mysqli_close($link);
}
else{

    echo "Token missing";
}