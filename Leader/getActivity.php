<?php
include_once("db_connect.php");
$sql = "SELECT COUNT(pageLike) as TotalLike FROM `articalactivity` WHERE pageLike like'%like%' and PageId='". mysqli_real_escape_string($link,$_POST['PageID'])."'";
// excecute SQL statement
$result = mysqli_query($link,$sql);
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}else{
 // User array
 $main_arr=array();
while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  extract($row);
    $main_item=array(
      "TotalLike" => $TotalLike,
/*        "CategorieDescription" =>html_entity_decode($CategorieDescription),
 */      );
  }
  
  
 echo json_encode($main_item);
// close mysql connection
mysqli_close($link);
}
?>