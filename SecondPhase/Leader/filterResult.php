
<?php 
include_once("db_connect.php");
$fl= $_POST['fl'];
$pg=$_POST['pg']; 
$UserId= $_POST['userid'];
if($fl=="REFLECT"){
    /* $query= "SELECT pageId,Title,strapline,articalFolder,Description,Category,Filter,CapabilityTag,Keyword,SecondaryLeadership,imageName
     FROM leaderlearningmoment WHERE Category Like '%$pg%' ORDER BY pageRanking"; */
   $query="SELECT pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,(SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment, (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike 
    FROM leaderlearningmoment as a WHERE Category Like '%$pg%' ORDER BY pageRanking";
  $result = mysqli_query($link,$query);
    // die if SQL statement failed
    if (!$result) {
    http_response_code(404);
    }
    else{
        $rowcount=mysqli_num_rows($result);
        if($rowcount){
            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
             ?>
           <div class="main" id="main">
           <a  href='/Leader/content/<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' target="_self"> <img  src="/Portal/uploadedImages/<?php echo $row['imageName'];?>"  class="lmimage" ></a>
           <h2 class="subtitle"><?php echo $row['series']; ?></h2>
           <a  href='/Leader/content/<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' style='text-decoration: none' target="_self">  <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['Title']; ?></u></h1>    </a>                                
           <h2 class="subtitle"><?php echo $row['strapline']; ?></h2>
               <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;"><?php echo $row['Description']; ?></p>
               <div style="/*margin:0 auto;*/ border-bottom:1px dotted #e6e7e8;/*max-width:80%;*/">
                   <div class="links-item-container" align="center">
                 
                   <i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews"><?php echo $row['noView'];?></span>
                  
                   <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes"><?php echo $row['noPagelike'];?></span>
                   
                   <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['noComment'];?></span>
                   </div>
                   <br/>
                   <a  href='/Leader/content/<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>   

<!--                         <div class="keyword"><span>keyword1</span>|<span>keyword1</span>|<span>keyword1</span>|<span>keyword1</span>|<span>keyword1</span></div>
       --> </div>           
           </div>
        <?php
            }
        }
        else{
            echo"NO Record Found!!";
        }  
    } 
}else{
    $queryCheck="SELECT * FROM LeaderActivityPagelike WHERE UserID='".$UserId."'";
    
  //$query_fl= "SELECT Title,strapline,Description,Links,Category,Filter,CapabilityTag,Keyword,SecondaryLeadership,imageName FROM leaderassociation WHERE Filter Like '%$fl%' and Category Like '%$pg%' ORDER BY pageRanking";
   $query_fl="SELECT DISTINCT ID,Title,strapline,Description,Links,Category,Filter,CapabilityTag,Keyword,SecondaryLeadership,imageName ,
               (SELECT GROUP_CONCAT(UserId) FROM LeaderActivityPagelike WHERE ActivityID=leaderassociation.ID) AS CmtLikedId,        

    (SELECT COUNT(pageLike) from LeaderActivityPagelike where ActivityID=leaderassociation.ID ) as likepg,
     (SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID=leaderassociation.ID )as
      comment FROM leaderassociation WHERE Filter Like '%$fl%' and Category Like '%$pg%' ORDER BY pageRanking"; 
   $result_fl = mysqli_query($link,$query_fl);
   

        // die if SQL statement failed
        if (!$result_fl) {
        http_response_code(404);
        }
        else{
            $pattern2="/,/";
            
            $rowcount=mysqli_num_rows($result_fl);
            if($rowcount){
                while ($row = mysqli_fetch_array($result_fl, MYSQL_BOTH)) {
                    $disabled="";
                    $content="LIKE";
                    $class="fa fa-heart fa-fw faAction";
                  if($row['CmtLikedId']){
                        if(preg_match ($pattern2 , $row['CmtLikedId'])){
                                $lookup = preg_split($pattern2, $row['CmtLikedId']);
                            for($i=0;$i<= count($lookup); $i++){
                                if ($lookup[$i] == $UserId) {
                                    $disabled='style=" pointer-events: none;"';
                                    $content="LIKED";
                                    $class="fa fa-fw fa-heart faView";
                                    
                                    break;
                                }else{
                                    $disabled="";
                                }
                        }
                    }else{
                        if ($row['CmtLikedId'] == $UserId) {
                            $disabled='style=" pointer-events: none;"';
                            $content="LIKED";
                            $class="fa fa-fw fa-heart faView";
                            
                        }else{
                            $disabled="";
                        }
                    }
            }
                  
                    //  $pos = strpos($row['Links'], "//");
                 $pattern ='%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s';
                  //if (preg_match($regex,  $row['Links'])) {}
                    
                    if(preg_match($pattern,  $row['Links'])){
                    $link=$row['Links'];
                    }else{
                        $link="/Portal/PDF/".$row['Links'];
                    }  ?>
                    <div class="main" id="main">
                    <a href='<?php echo $link;?>' target="_blank" > <img  src="/Leader/assets/images/<?php echo $row['imageName'];?>" style="max-width:100%" >  </a>  
                        <h2 class="subtitle"><?php echo $row['strapline']; ?></h2>
                        <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['Title']; ?></u></h1>                                    
                        <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;"><?php echo $row['Description']; ?></p>
                        <div style="/*margin:0 auto;*/ border-bottom:1px dotted #e6e7e8;/*max-width:80%;*/">
                        <div class="links-widget component-widget">
                                            <div class="links-item component-item clearfix top">
                                                <div class="links-item-container" id="pgActivity" align="center">
                                               
                                                    <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes<?php echo $row['ID']?>"><?php echo $row['likepg'];?></span>
                                                    
                                                    <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['comment'];?></span>
                                                    
                                                </div>
                                                
                        
                        <div class="links-item-container" align="center">                                                                      
                            <a href="#" class="links-item-link like-buttons"<?php echo $disabled;?> id="LIKE-<?php echo $row["ID"];?>">
                            <i class='<?php echo $class;?>'></i><span class="faActionText"><?php echo  $content;?>&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                            </a>
                            <span class="separator"></span>
                            <a href="#" class="links-item-link like-comment" id="<?php echo $row["ID"];?>">
                            <i class="fa fa-comment fa-fw faAction"></i><span class="faActionText">COMMENT</span> 
                            </a> 
                        </div>
                        <div id="divAddComment<?php echo $row["ID"];?>" class="divAddComment" >
                        <!-- coment -->    
                        <div class="links-body component-body">
                        <div class="links-body-inner component-body-inner">
                        </div>
                    </div>

                    <div>
                        <textarea id="comment<?php  echo $row["ID"];?>" name="comment" placeholder="Enter comment here..." style="min-height: 200px;width:100%; background-color:#eee; border:none;"></textarea>
                    </div>

                    <div class="buttons-cluster-bottom clearfix" align="center">
                        <div class="buttons-marking-icon icon display-none">
                        </div>                        
                        <a href="#" class="Postcomment" id="<?php  echo $row["ID"];?>">POST COMMENT</a>

                    </div>
                            <!--Coment -->  
                            <div class="buttons-cluster-bottom clearfix" align="center">
                              <div class="buttons-marking-icon icon display-none">
                                </div>
                            </div>
                             <div class="comments-container" id="listComments<?php  echo $row['ID'];?>">
                             </div>                             
                         </div>
                        <br/>
                     </div>           
                </div>
                </div>
                </div>
            <?php
                }
            }
            
    }
}
?>