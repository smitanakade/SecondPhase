<?php
include_once("db_connect.php");
mysqli_set_charset($link,"utf8");
if(isset($_GET)){
  $category = $_GET['pg'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
    $search =$_POST["search"];
    $sql='';
    //commented below because myer wants to search entire Leader side
  /*  if($category){
    $sql="SELECT a.pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,(SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment, (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike  FROM leaderlearningmoment as a WHERE Title LIKE '%".$search."%' or strapline LIKE '%".$search."%' or Category LIKE'%".$search."%' or Filter LIKE '%".$search."%' or CapabilityTag LIKE '%".$search."%' or  SecondaryLeadership LIKE '%".$search."%' or Keyword LIKE '%".$search."%' or Description LIKE '%".$search."%' and Category='%".$category."%' ORDER BY pageRanking";
    
   }else{ */
   // $sql="SELECT a.pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,(SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment, (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike  FROM leaderlearningmoment as a WHERE Title LIKE '%".$search."%' or strapline LIKE '%".$search."%' or Category LIKE'%".$search."%' or Filter LIKE '%".$search."%' or CapabilityTag LIKE '%".$search."%' or  SecondaryLeadership LIKE '%".$search."%' or Keyword LIKE '%".$search."%' or Description LIKE '%".$search."%' ORDER BY pageRanking";
    $sql="SELECT a.pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,
    (SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment,
     (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,
    (SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike 
     FROM leaderlearningmoment as a WHERE
      match(Title) against ('".$search."') or
      match(strapline) against ('".$search."')  or
      match(Category) against ('".$search."') or 
     match(CapabilityTag) against ('".$search."')  or
      match(SecondaryLeadership) against ('".$search."')  or
      match(Keyword) against ('".$search."')  or
        match(MainCategory) against ('".$search."')  or
        match(series) against ('".$search."')  or
    
     match(Description) against ('".$search."') ORDER BY pageRanking";
  // echo $sql;
    $result = mysqli_query($link,$sql);
    
   // die if SQL statement failed
   if (!$result) {
     http_response_code(404);
   }else{
    // $main_arr=array();
    // $main_arr["records"]=array();
   $rowCount = mysqli_num_rows($result);
   if($rowCount >0){
     $i=0;
     $html="";
    while($row_sub= mysqli_fetch_array($result)){
       
        if($i==3){
            break;
          }
        $html.= '<div class="main" id="main">'.
        '<a href="/Leader/content/'.$row_sub['articalFolder'].'/index.html#/id/'.$row_sub['pageId'].'" style="text-decoration: none; ;"> '.
        '<img  src="/Portal/uploadedImages/'. $row_sub['imageName']. '"  class="lmimage" ></a'.
        '<h2 class="subtitle">'.$row_sub['series'].'</h2>'.
        '<a href="/Leader/content/'.$row_sub['articalFolder'].'/index.html#/id/'.$row_sub['pageId'].'" style="text-decoration: none; ;"> '.        
        '<h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;">'.$row_sub['Title'].'</u></h1></a>'. 
        '<h2 class="subtitle">'.$row_sub['strapline'].'</h2>'.        
        '<p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;; ">'.$row_sub['Description']. '</p>'.
        '<div style="border-bottom:1px dotted #e6e7e8;">'.
        '<div class="links-item-container" align="center">';
         $html.='<i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews">'. $row_sub['noView'].'</span>';  
        $html.='<i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes">'. $row_sub['noPagelike'].'</span>';
        $html.='<i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments">'.$row_sub['noComment'].'</span>'.
        '</div><br/>'.        
        '<a  href="/Leader/content/'.$row_sub['articalFolder'].'/index.html#/id/'. $row_sub['pageId'].'" target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>'. 
   '</div>';
$i++;
       
      }
    //  echo "HHHHHH";
//checking Activity table 
//$activityQuery="SELECT Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName , (SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID = a.ID) as noComment,(SELECT COUNT(pageLike) FROM LeaderActivityPagelike WHERE ActivityID= a.ID) as noPagelike FROM leaderassociation as a  WHERE Title LIKE '%".$search."%' or series LIKE '%".$search."%' or strapline LIKE '%".$search."%' or Description LIKE '%".$search."%' or Links LIKE '%".$search."%' or ActivityDuration LIKE '%".$search."%' or Category LIKE '%".$search."%' or Filter LIKE '%".$search."%' or CapabilityTag LIKE '%".$search."%' or TopicSearchTags LIKE '%".$search."%' or Keyword LIKE '%".$search."%' or SecondaryLeadership LIKE '%".$search."%' or imageName LIKE '%".$search."%' and Filter NOT IN('Reflect - Learning Moment') ORDER BY pageRanking";
$activityQuery="SELECT Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName ,
(SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID = a.ID) as noComment,(SELECT COUNT(pageLike) FROM LeaderActivityPagelike 
WHERE ActivityID= a.ID) as noPagelike FROM leaderassociation 
as a  WHERE 
match(Title) against ('".$search."') or
match(series ) against ('".$search."') or 
match(strapline) against ('".$search."') or
match(Description) against ('".$search."') or
match(Links) against ('".$search."') or 
match(Category) against ('".$search."') or
match(Filter) against ('".$search."') or
match(CapabilityTag) against ('".$search."') or
match(TopicSearchTags) against ('".$search."') or
match(Keyword) against ('".$search."') or
match(SecondaryLeadership) against ('".$search."') or
match(imageName) against ('".$search."')
and Filter NOT IN('Reflect - Learning Moment')  ORDER BY pageRanking";
$activityresult = mysqli_query($link,$activityQuery);
//echo $activityQuery;
// die if SQL statement failed
if (!$activityresult) {
 http_response_code(404);
}else{

  $ActRowCount = mysqli_num_rows($activityresult);
    if($ActRowCount >0){

      while($rowAct= mysqli_fetch_array($activityresult)){
        $pattern ='%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s';
        //if (preg_match($regex,  $row['Links'])) {}
          
          if(preg_match($pattern,  $rowAct['Links'])){
          $link=$rowAct['Links'];
          }else{
              $link="/Portal/PDF/".$rowAct['Links'];
          }
        if($i==3){
          break;
        }
      $html.= '<div class="main" id="main">'.
      '<a href="'.$link.'" target="_blank" style="text-decoration: none; ;"> '.
      '<img  src="/Leader/assets/images/'. $rowAct['imageName']. '"  class="lmimage" ></a>'.
      '<h2 class="subtitle">'.$rowAct['series'].'</h2>'.
      '<a href="'.$link.'" style="text-decoration: none;"> '.
      '<h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;">'.$rowAct['Title'].'</u></h1></a>'. 
      '<h2 class="subtitle">'.$rowAct['strapline'].'</h2>'.        
      '<p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;;">'.$rowAct['Description']. '</p>'.
      '<div style="border-bottom:1px dotted #e6e7e8;">'.
      '<div class="links-item-container" align="center">';
      $html.='<i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes">'. $rowAct['noPagelike'].'</span>';
      $html.='<i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments">'.$rowAct['noComment'].'</span>'.
      '</div><br/>'.        
      '<a href="'.$link.'" target="_blank" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>'. 
        '</div>';
    $i++;
      }
    }
}






if($i==3){
  
  $html .='<div >'.
  '<a href="/Leader/searchResult.php?sh='.$_POST["search"].'" class="button_cust"  target="_self" >'.  
  'SHOW MORE...</a> &nbsp; &nbsp; <a href="#" class="button_cust"  target="_self" id="clearsearch">CLEAR SEARCH </a></div>';
  }
            echo $html;
      //echo json_encode($main_arr);
    }else{
      //checking Activity table 
//$activityQuery="SELECT Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName , (SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID = a.ID) as noComment,(SELECT COUNT(pageLike) FROM LeaderActivityPagelike WHERE ActivityID= a.ID) as noPagelike FROM leaderassociation as a  WHERE Title LIKE '%".$search."%' or series LIKE '%".$search."%' or strapline LIKE '%".$search."%' or Description LIKE '%".$search."%' or Links LIKE '%".$search."%' or ActivityDuration LIKE '%".$search."%' or Category LIKE '%".$search."%' or Filter LIKE '%".$search."%' or CapabilityTag LIKE '%".$search."%' or TopicSearchTags LIKE '%".$search."%' or Keyword LIKE '%".$search."%' or SecondaryLeadership LIKE '%".$search."%' or imageName LIKE '%".$search."%' and Filter NOT IN('Reflect - Learning Moment') ORDER BY pageRanking";
$activityQuery="SELECT Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName ,
(SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID = a.ID) as noComment,(SELECT COUNT(pageLike) FROM LeaderActivityPagelike 
WHERE ActivityID= a.ID) as noPagelike FROM leaderassociation 
as a  WHERE 
match(Title) against ('".$search."') or
match(series ) against ('".$search."') or 
match(strapline) against ('".$search."') or
match(Description) against ('".$search."') or
match(Links) against ('".$search."') or 
match(Category) against ('".$search."') or
match(Filter) against ('".$search."') or
match(CapabilityTag) against ('".$search."') or
match(TopicSearchTags) against ('".$search."') or
match(Keyword) against ('".$search."') or
match(SecondaryLeadership) against ('".$search."') or
match(imageName) against ('".$search."')
and Filter NOT IN('Reflect - Learning Moment')  ORDER BY pageRanking";
$activityresult = mysqli_query($link,$activityQuery);
//echo $activityQuery;
// die if SQL statement failed
if (!$activityresult) {
 http_response_code(404);
}else{

  $ActRowCount = mysqli_num_rows($activityresult);
    if($ActRowCount >0){

      while($rowAct= mysqli_fetch_array($activityresult)){
        $pattern ='%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s';
        //if (preg_match($regex,  $row['Links'])) {}
          
          if(preg_match($pattern,  $rowAct['Links'])){
          $link=$rowAct['Links'];
          }else{
              $link="/Portal/PDF/".$rowAct['Links'];
          }
        if($i==3){
          break;
        }
      $html.= '<div class="main" id="main">'.
      '<a href="'.$link.'" target="_blank" style="text-decoration: none;"> '.
      '<img  src="/Leader/assets/images/'. $rowAct['imageName']. '"  class="lmimage" ></a>'.
      '<h2 class="subtitle">'.$rowAct['series'].'</h2>'.
      '<a href="'.$link.'" target="_blank" style="text-decoration: none;"> '.
      '<h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;">'.$rowAct['Title'].'</u></h1></a>'. 
      '<h2 class="subtitle">'.$rowAct['strapline'].'</h2>'.        
      '<p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;">'.$rowAct['Description']. '</p>'.
      '<div style="border-bottom:1px dotted #e6e7e8;">'.
      '<div class="links-item-container" align="center">';
      $html.='<i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes">'. $rowAct['noPagelike'].'</span>';
      $html.='<i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments">'.$rowAct['noComment'].'</span>'.
      '</div><br/>'.        
      '<a href="'.$link.'" target="_blank" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>'. 
        '</div>';
    $i++;
      }
      if($i==3){
        $html .='<div >'.
        '<a href="/Leader/searchResult.php?sh='.$_POST["search"].'" class="button_cust"  target="_self" >'.  
        'SHOW MORE...</a> &nbsp; &nbsp; <a href="#" class="button_cust"  target="_self" id="clearsearch">CLEAR SEARCH </a></div>';
        }
                  echo $html;
    }
    else{
      $html='<div >
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="font-size: 48px;color: #fbab92"></span>
      <br/><br/>
      <div id="SearchResultDiv">Oops! we couldn&#39;t find any results matching "'. $search.'"</div>
      <br/>
      <a href="#" class="button_cust"  target="_self" id="clearsearch">CLEAR SEARCH </a>
      </div>';
            echo($html);

    }
}

     
    }
      
    }
    
  }

?>