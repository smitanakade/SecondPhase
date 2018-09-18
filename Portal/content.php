<?php
include_once("database.php");
$sql = "SELECT Id as mainId,UPPER(CategorieDescription) as CategorieDescription From maincategories WHERE Id IN (SELECT mainCatId FROM submaincategory)
ORDER BY Id ";
// excecute SQL statement
$result = mysqli_query($link,$sql);
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}else{
 // User array
 $main_arr=array();

 $sub_arr=array();
 $sub_item=array();
$third_arr=array();
$third_item=array();
while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  extract($row);
    $main_item=array(
      "mainId" => $mainId,
       "CategorieDescription" =>html_entity_decode($CategorieDescription),
      );
      $sub_arr=array();
      $sql_sub = "SELECT 	smId,UPPER(smDescription) AS subDescription,mainCatId FROM  submaincategory WHERE  mainCatId=".$mainId;
      $result_sub= mysqli_query($link,$sql_sub);
      $count = mysqli_num_rows($result_sub);
      if($count){
        while($sub_item= mysqli_fetch_array($result_sub, MYSQLI_ASSOC)){
          $third= "SELECT thLid, thlDescription FROM thirdlevelgroup WHERE mainCatId='".$sub_item['mainCatId']."' AND subCategorieId='".$sub_item['smId']."'";
          $thirdResult = mysqli_query($link,$third);
          $thcount = mysqli_num_rows($thirdResult);
          $third_arr=array();
          if($thcount){
             while($third_item= mysqli_fetch_array($thirdResult,MYSQLI_ASSOC)){
              // $third_arr["third"]=$third_item;
               array_push($third_arr,$third_item);
             }
          }
          $sub_item["third"]=$third_arr;
         // array_push($sub_item,$third_arr);
          array_push($sub_arr,$sub_item);
        
        }
        $main_item["sub"]=$sub_arr;
   
      }
     
   array_push($main_arr, $main_item);
      
  

  }
  
  
 echo json_encode($main_arr);
// close mysql connection
mysqli_close($link);
}
?>