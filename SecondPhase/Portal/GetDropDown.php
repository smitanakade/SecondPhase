<?php 
include_once("db_connect.php");

if($_POST['MainCategory']){
    $html="";
    $getSUbCat_query= "SELECT smId,smDescription FROM subMainCategory WHERE mainCatId IN (SELECT Id FROM maincategories where CategorieDescription LIKE '%".mysqli_real_escape_string($link,$_POST['MainCategory'])."%') ORDER BY smDescription ASC";
   $result=mysqli_query($link, $getSUbCat_query);
    while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
    extract($row);
    $html.='<option value="'.$subMainCategory.'">'.$subMainCategory.'</option>';  
    }
    echo $html;
}
if($_POST['subMainCategory']){
    $html="";
   $gethirdCat_query="SELECT thLid,thlDescription FROM `thirdlevelgroup` as thd JOIN subMainCategory as sub on sub.smId=thd.subCategorieId and thd.mainCatId= sub.mainCatId WHERE sub.smDescription='%".mysqli_real_escape_string($link,$_POST['subMainCategory']).."%' ORDER BY thlDescription ASC";
    $result=mysqli_query($link, $gethirdCat_query);
    while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
    extract($row);
    $html.='<option value="'.$thlDescription.'">'.$thlDescription.'</option>';  
    }
    echo $html;
}

?>