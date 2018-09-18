
<?php
include_once "db_connect.php";
if (isset($_POST)) {
    if ($_POST['fl'] == "comment") {
    $user_Id = $_POST['userId'];        
   
//taking page rating given by login user

        $sql_comment = "
        SELECT
            A.ID,
            A.ActivityID,
            A.Comment,
            DATE_FORMAT(A.CommentedON,'%d %M %Y') AS CommentedON,
            U.NameReport,
            U.EmployeeNo,
            (SELECT GROUP_CONCAT(UserId) FROM LeaderCommentLike WHERE CommentID = A.ID) AS CmtLikedId,        
            (SELECT COUNT(CommentLike) FROM LeaderCommentLike WHERE CommentID = A.ID) AS CommentLIKE,
            (SELECT COUNT(ReplyComment) FROM LeaderActivityReply WHERE CommentID = A.ID) AS ReplyCnt
        FROM
            LeaderActivityComment AS A,
            userdetails AS U
        WHERE
            A.UserID = U.EmployeeNo AND
            A.ActivityID=" . mysqli_real_escape_string($link, $_POST['Id']) . " ORDER BY A.CommentedON DESC";

        $result_comment = mysqli_query($link, $sql_comment);
        $pattern="/,/";
        
        $html = '<ul id="comments-list" class="comments-list">';
        if (!$result_comment) {
            http_response_code(404);
            die(mysqli_error());
        } else {

            while ($data = mysqli_fetch_array($result_comment, MYSQL_ASSOC)) {
              // Start HERE ---Below code is used to disable like button and change text
              $disabled="";
              $content="LIKE";
            if($data['CmtLikedId']){
                  if(preg_match ($pattern , $data['CmtLikedId'])){
                          $lookup = preg_split($pattern, $data['CmtLikedId']);
                      for($i=0;$i<= count($lookup); $i++){
                          if ($lookup[$i] == $user_Id) {
                              $disabled='style=" pointer-events: none;"';
                              $content="LIKED";
                              break;
                          }else{
                              $disabled="";
                          }
                  }
              }else{
                  if ($data['CmtLikedId'] == $user_Id) {
                      $disabled='style=" pointer-events: none;"';
                      $content="LIKED";
                      
                  }else{
                      $disabled="";
                  }
              }
      }
  // END HERE ---Below code is used to disable like button and change text 
                $html .= '<li> <div class="comment-main-level" id="comment_551">
             <div class="comment-avatar">
       <img src="/Leader/assets/images/avatar_2x.png" alt=""></div>
        <div class="comment-box">
       <div class="comment-head">
        <h6 class="comment-name">' . $data['NameReport'] . '</h6>
         </div>
         <div class="comment-content" style="text-align:left;" id="comment' . $data["ID"] . '">' . $data['Comment'] . '</div>
           <div class="comment-head" style="text-align:left;"> <i class="fa fa-heart"></i>' . $data['CommentLIKE'] . ' </div> <div class="comment-head">
           <div class="comment-date">' . $data["CommentedON"] . '</div>
           <div id="commentActivity' . $data["ID"] . '" class="commentActivity" >
           <span class="commentActivityLinks">
           <a href="#" class="comment-like1" '.$disabled.' id=' . $data['ID'] . '>'.$content.'</a>';

                if ($data['ReplyCnt'] == 0) {
                    $html .= ' <a href="#" class="comment-SeeReply" id=' . $data['ID'] . '>REPLY</a>';
                } else {
                    $html .= ' <a href="#" class="comment-SeeReply" id=replyshow' . $data['ID'] . '>SHOW REPLIES</a>';

                }
                if ($data['EmployeeNo'] == $user_Id) {
                    $html .= ' <a href="#" class="comment-Edit" id="Edit' . $data['ID'] . '">EDIT</a> ';

                }
                $html .= "</span>";

                $html .= '<div  class="replyBox" id="replyBox' . $data['ID'] . '"> <div class="seeReply' . $data['ID'] . '"></div></div></div> </div> </div>
            </div>';

            }

        }
        $html .= '</ul>';

        echo $html;
    }
    if ($_POST['fl'] == 'like') {
        $html = "";

        //Getting total number of like
        $getLikequery = "SELECT count(pageLike)as pgLike FROM LeaderActivityPagelike WHERE pageLike !='' and ActivityID='" . mysqli_real_escape_string($link, $_POST['Id']) . "'";
        $resultLike = mysqli_query($link, $getLikequery);
        if (!$resultLike) {
            http_response_code(404);
            die(mysqli_error());
        } else {

            $rowView = mysqli_fetch_assoc($resultLike);
            $html .= '    <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes">' . $rowView['pgLike'] . '</span>';

        }

        //getting page tatal page comment
        $getCommentQuery = "SELECT count(Comment) as comment FROM LeaderActivityComment WHERE Comment !='' and ID='" . mysqli_real_escape_string($link, $_POST['Id']) . "'";
        $resultComment = mysqli_query($link, $getCommentQuery);
        if (!$resultComment) {
            http_response_code(404);
            die(mysqli_error());
        } else {

            $rowView = mysqli_fetch_assoc($resultComment);
            $html .= '<i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments">' . $rowView['comment'] . '</span>';

        }
        echo $html;

    }
    if ($_POST['fl'] == 'insetCmt') {

        $insertQuery = "INSERT INTO LeaderActivityComment (ActivityID,UserID,Comment,CommentedON) VALUES ('" . mysqli_real_escape_string($link, $_POST['Id']) . "','" . mysqli_real_escape_string($link, $_POST['userId']) . "','" . mysqli_real_escape_string($link, $_POST['cmt']) . "',now())";
        echo $insertQuery;
        mysqli_query($link, $insertQuery);
    }

    if ($_POST['fl'] == "pgLike") {
        $id= explode("LIKE-",$_POST['Id']);
        $query = "SELECT * from LeaderActivityPagelike where ActivityID ='" . mysqli_real_escape_string($link, $id[1]) . "' and UserID='" . mysqli_real_escape_string($link, $_POST['userId']) . "'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0 ? "" :
            mysqli_query($link, "INSERT INTO LeaderActivityPagelike (ActivityID,UserID,pagelike,likedON) VALUES ('" . mysqli_real_escape_string($link, $id[1]) . "','" . mysqli_real_escape_string($link, $_POST['userId']) . "','like',NOW()) "));
    }
// Close connection
    mysqli_close($link);
}

?>