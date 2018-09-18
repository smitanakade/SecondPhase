<?php       
 $table = $_GET['type']; 
 include("db_connect.php");   
 header('Content-Type: text/csv; charset=utf-8');  
 header('Content-Disposition: attachment; filename='.$table.'.csv');  
 $output = fopen("php://output", "w"); 
 if($table=='userdetails'){
    fputcsv($output, array('EmployeeNo','NameReport','EmpStatus','EmpStatDesc','OccStateCode','AdminDesc','Department','updatedOn'));  
 }
if($table == 'leaderassociation'){
    fputcsv($output, array('Id','Title','series','strapline','Description','Links','ActivityDuration','MainCategory','Category','Filter','CapabilityTag','TopicSearchTags','Keyword','SecondaryLeadership','pageRanking','imageName','updateOn'));  
    
}
if($table == 'academyLM'){
    fputcsv($output, array('Id','pageId','PageTitle','series','strapline','articalFolder','pageDescription','keyword','MainCategory','SubCategory','ThirdLevelCategory','pageRanking','ImageName','DisplayKeywords','updatedon' ));
}
if($table == 'leaderlearningmoment'){
    fputcsv($output, array( 'ID','pageId','Title','series','strapline','articalFolder','Description','Links','MainCategory','category','CapabilityTag','TopicSearchTags','Keyword','SecondaryLeadership','pageRanking','imageName','updateOn' ));
}
 $query = "SELECT * from ".$table; 
 $result = mysqli_query($link, $query);  
 while($row = mysqli_fetch_assoc($result))  
 {  
      fputcsv($output, $row);  
 }  
 fclose($output);   
 ?>