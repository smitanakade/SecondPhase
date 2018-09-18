<?php
include_once("database.php");
$sql = "SELECT ID,UPPER(Category) as 	Category From leadermaincat ORDER BY Id ";
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
      "ID" => $ID,
       "Category" =>html_entity_decode($Category),
      );
    array_push($main_arr, $main_item);
  }
    echo json_encode($main_arr);
// close mysql connection
mysqli_close($link);

}
?>