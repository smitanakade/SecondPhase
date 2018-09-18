<?php
include_once("db_connect.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
    $fl= $_POST['fl'];
    if(isset($_POST['qu'])){
        $queryString= $_POST['qu'];
        $lookup= split("=",$queryString);
        $thHead= $lookup[0];
        $Category = $lookup[1];

        if($thHead =="thd"){
            $search="ThirdLevelCategory='".$Category."'";    
        }
        else{
            $search="SubCategory='".$Category."'";
        }
        $whereClause = "WHERE ".$search;
    }
    else{
        $whereClause ="";
    }
   
    $sql="SELECT a.pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory, ThirdLevelCategory,ImageName,(SELECT COUNT(Comment) FROM LMComment WHERE PageID = a.pageId) as noCooment, (SELECT COUNT(pageId) FROM AcadmeyUsertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LMPagelike WHERE PageID= a.pageId) as noPagelike FROM academyLM as a ";
    if($fl=="OLDEST"){
      $sql.="LEFT OUTER JOIN LMComment as lmc on a.pageId = lmc.PageID LEFT OUTER JOIN LMPagelike as lmpk on a.pageId = lmpk.PageID  ".$whereClause."  GROUP BY a.pageId ORDER BY lmc.CommentedON,lmpk.likedON ASC";
    }
    if($fl=="RECENT"){
      $sql.="LEFT OUTER JOIN LMComment as lmc on a.pageId = lmc.PageID LEFT OUTER JOIN LMPagelike as lmpk on a.pageId = lmpk.PageID   ".$whereClause."  GROUP BY a.pageId ORDER BY lmc.CommentedON,lmpk.likedON DESC";
    }
    if($fl=="MOST POPULAR"){
      $sql.="LEFT OUTER JOIN LMComment as lmc on a.pageId = lmc.PageID LEFT OUTER JOIN LMPagelike as lmpk on a.pageId = lmpk.PageID   ".$whereClause."  GROUP BY a.pageId ORDER BY (noCooment+noPagelike) DESC";
    }
   // echo $sql;
    $result = mysqli_query($link,$sql);
    
   // die if SQL statement failed
   if (!$result) {
     http_response_code(404);
   }else{
    $main_arr=array();
    $main_arr["records"]=array();
   $rowCount = mysqli_num_rows($result);
   $html="";
   if($rowCount >0){
     
    while($row_sub= mysqli_fetch_array($result, MYSQL_BOTH)){
        extract($row_sub);
       
      $html.= '
      <div class="main" id="main">'.
      '<a href="/content/'.$row_sub['articalFolder'].'/index.html#/id/'.$row_sub['pageId'].'" style="text-decoration: none; color:#000;"> '.
      '<img  src="/Portal/uploadedImages/'. $row_sub['ImageName']. '"  class="lmimage" ></a>'.
      '<h2 class="subtitle">'.$row_sub['series'].'</h2>'.
      '<a href="/content/'.$row_sub['articalFolder'].'/index.html#/id/'.$row_sub['pageId'].'" style="text-decoration: none; color:#000;"> '.
      '<h1 class="headLine2"style="text-decoration: none;"><u style=" text-decoration: none;border-bottom: 1px solid #939393;">'.$row_sub['PageTitle'].'</u></h1></a>'.
      '<h2 class="subtitle">'.$row_sub['strapline'].'</h2>'.      
      '<p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;">'.$row_sub['pageDescription']. '</p>'.
      '<div style="border-bottom:1px dotted #e6e7e8;">'.
      '<div class="links-item-container" align="center">';
      $html.='<i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews">'. $row_sub['noView'].'</span>'; 
      $html.='<i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes">'. $row_sub['noPagelike'].'</span>';  
      $html.='<i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments">'.$row_sub['noCooment'].'</span>'.
      '</div><br/>'.        
      '<a  href="/content/'.$row_sub['articalFolder'].'/index.html#/id/'. $row_sub['pageId'].'" target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>'. 
 '</div>';
      }
      
        
      echo($html);
    }else{
      $html='<div >
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="font-size: 48px;color: #fbab92"></span>
  <br/><br/>
  <div id="SearchResultDiv">Oops! we couldn&#39;t find any results matching "'.$_POST['sh'].'"</div>
  <br/>
  </div>';
      echo($html);
    }
      
    }
    
  }

?>