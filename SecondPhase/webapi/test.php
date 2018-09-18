<?php 

include_once("database.php");
$sql = "SELECT Id as mainId,UPPER(CategorieDescription) as CategorieDescription From maincategories WHERE Id IN (SELECT mainCatId FROM submaincategory)
ORDER BY Id ";
echo $sql;
?>