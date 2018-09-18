<?php
include_once ("db_connect.php");
if (isset($_POST))
	{
        if($_POST['fl']=="cmtLike" ){
            print_r($_POST);
                $query ="SELECT * from LMCommentLike where CommentID ='" . mysqli_real_escape_string($link, $_POST['cId']) . "' and UserID='" . mysqli_real_escape_string($link, $_POST['userId']) . "'";
                
                $result = mysqli_query($link,$query);
                    
                    if (mysqli_num_rows($result) > 0 ? "" : 
                    mysqli_query($link, "INSERT INTO LMCommentLike (CommentID,UserID,CommentLike,likedOn) VALUES ('" . mysqli_real_escape_string($link, $_POST['cId']) . "','" . mysqli_real_escape_string($link, $_POST['userId']) . "','like',NOW()) "));
        }    
        if ($_POST['fl'] == 'updateComment')
        {
            
                $updateQuery="update LMComment set Comment ='" . mysqli_real_escape_string($link, $_POST['cmt']) . "', CommentedON=NOW() where ID='".mysqli_real_escape_string($link,$_POST['cId'])."' and UserID='" . mysqli_real_escape_string($link, $_POST['userId']) . "'";
                mysqli_query($link, $updateQuery);
        } 
        
        if($_POST['fl']== 'PostReply'){
                $insertReplyComment="INSERT INTO LMCommentReply (UserID,CommentID,ReplyComment,CommentedON) VALUES ('" . mysqli_real_escape_string($link, $_POST['userId']) . "','" . mysqli_real_escape_string($link, $_POST['cId']) . "','" . mysqli_real_escape_string($link, $_POST['reply']) . "',NOW()) ";
                mysqli_query($link, $insertReplyComment);
        }            
        if($_POST['fl']== 'getReply'){
                $user_Id=$_POST['userId'];                
                $Replycomment = "SELECT a.ID,ac.PageID,a.CommentID,a.ReplyComment,DATE_FORMAT(a.CommentedON,'%d %M %Y') AS CommentedON,u.NameReport,u.EmployeeNo FROM LMCommentReply as a,userdetails as u, LMComment as ac where a.UserID= u.EmployeeNo and ac.ID = a.CommentID and a.CommentID='" . mysqli_real_escape_string($link, $_POST['cId']) . "'";
                $result_reply= mysqli_query($link,$Replycomment);
                $html='<!-- Reply comment -->    
                <div class="links-body component-body">
                <div class="links-body-inner component-body-inner">
                </div>
            </div>

            <div>
                <textarea id="reply'.$_POST['cId'].'" name="reply"  placeholder="Enter reply comment here..." style="min-height: 200px;width:100%; background-color:#eee; border:none;"></textarea>
            </div>

            <div class="buttons-cluster-bottom clearfix" align="center">
                <div class="buttons-marking-icon icon display-none">
                </div>
               
                <a href="#" class="PostReply" id="'.$_POST['cId'].'">POST REPLY</a>

            </div><!-- Replycomment --><ul id="comments-list" class="comments-list">';
                if (!$result_reply) {
                    http_response_code(404);
                    die(mysqli_error());
                }else{
                    
                    while ($data = mysqli_fetch_array($result_reply, MYSQL_ASSOC)) {
                    $html.= '<li> <div class="comment-main-level" id="comment_551">
                         <div class="comment-avatar">
                   <img src="/Leader/assets/images/avatar_2x.png" alt=""></div>
                    <div class="comment-box">
                   <div class="comment-head">
                    <h6 class="comment-name">'.$data['NameReport'].'</h6> 
                     </div>
                     <div class="comment-content" style="text-align: left;" id="comment'.$data["ID"].'">'.$data['ReplyComment'].'</div>
                       <div class="comment-date">'.$data["CommentedON"].'</div>
                       <div id="commentActivity'.$_POST['cId'].'" class="commentActivity">';                      
                         $html.='</div> </div> </div> 
                        </div>';
            
                    }	
                    
                }
                $html.='</ul>';
            
                echo $html;
        }
        // Close connection
        mysqli_close($link);
}
?>