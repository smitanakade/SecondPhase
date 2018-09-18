<?php
include_once("database.php");
$method = $_SERVER['REQUEST_METHOD'];
if($method=="GET"){
    $subId= $_GET['var'];
    $sql = "SELECT 	CategorieId as subId,SubCategoryDescription From pageassociate where CategorieId=".$subId." ORDER BY CategorieId ";
    // excecute SQL statement
        $result = mysqli_query($link,$sql);
    // die if SQL statement failed
    if (!$result) {
    http_response_code(404);
    die(mysqli_error());
    }else{
    // User array
    $sub_arr=array();
    $sub_arr["subrecord"]=array();
    while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
    extract($row);
        $sub_item=array(
        "subId" => $subId,
        "SubCategoryDescription" =>html_entity_decode($SubCategoryDescription),
        );
        array_push($sub_arr["subrecord"], $sub_item);
        
    }
    echo json_encode($sub_arr);
    // close mysql connection
    mysqli_close($link);
}
}else{
    http_response_code(404);
    
}
?>