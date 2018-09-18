$(document).ready(function(){
    var full_url = document.URL;
    var stuff = full_url.split('/');
    //var pageId = stuff[stuff.length - 1];
    var userId = loginCheck.getUserID();
    //var Data = '&PageID=' + pageId ;
    var commentsHtml="";
    event.preventDefault();
/*     $('.divAddComment').css("display","none");
 */    $('.replyBox').css("display","none");
    var menu ="";
   
        $(".like-comment").click(function () {
            var rowid= this.id;
            event.preventDefault();
         /*    $('.divAddComment').css("display","none");       
            
            $("#divAddComment"+rowid).show(); */
            $("#section_"+rowid).show();
            var parameterData = '&fl=comment&userId=' + userId+'&Id='+rowid;
            getPreviousCmt(parameterData,rowid);
           
        });

        $(".like-buttons").click(function () {
            var RowId=this.id;
            alert(RowId);
            event.preventDefault();
            event.stopPropagation();
            $.ajax({
                url: '/Leader/LeaderActivityMonitor.php',                            
                data: '&userId=' + userId+'&Id='+RowId+'&fl=pgLike',
                type: "POST",     
                
            })
        });
        

    $(".Postcomment").click(function () {
        var row_id=this.id;
      //  alert(row_id);
        event.preventDefault();
        event.stopPropagation();
        var commentinsert=$('#comment'+row_id).val();
         
        $.ajax({
            url: '/Leader/LeaderActivityMonitor.php',                            
            data: '&fl=insetCmt&cmt='+commentinsert+'&userId=' + userId+'&Id='+row_id,
            type: "POST",     
            success: function (data) {
                $('#comment'+row_id).val("");
                var parameterData = '&fl=comment&userId=' + userId+'&Id='+row_id;
                getPreviousCmt(parameterData,row_id);
            }
        })
       
          //below ajax call getting page comment 
        
    });
    function getPreviousCmt(parameterData,rid){
        $.ajax({
            url: '/Leader/LeaderActivityMonitor.php',                            
            data: parameterData,
            type: "POST",     
            success: function (data) {
            commentsHtml=data;
           /*Adding fetched coment to the div */
            $("#listComments"+rid).html(commentsHtml);
            /*Adding fetched coment to the div */

              /*here genrating Comment like ajaxcode */
              getCommentLikeActivity(parameterData,rid);
              /*here genrating Comment like ajaxcode End */
            },
            error: function(data){
                console.log(data);
            }
        })
    }
    function getCommentLikeActivity(parameterData,rid){
        $(".comment-like1").click(function () {
            
              event.preventDefault();
              event.stopPropagation();
              cmtId= $(this).attr("id");

              cmtData='&fl=cmtLike&userId=' + userId+'&cId='+cmtId;
              $.ajax({
                  url: '/Leader/LeaderActivityAction.php',                            
                  data: cmtData,
                  type: "POST" ,
                  success: function(){
                    getPreviousCmt(parameterData,rid);
                  }   
              })
          });
          $(".comment-SeeReply").click(function(){
            event.preventDefault();
            event.stopPropagation();
            cmtId= $(this).attr("id");
            
            if($("#replyBox"+cmtId).css("display") == "none")
            {
                $('.replyBox').css("display","none");                       
                $("#replyBox"+cmtId).show();
            }else
            {
                $('.replyBox').css("display","none");
            } 
            
            replyData='&fl=getReply&userId=' + userId+'&cId='+cmtId;
            
            $.ajax({
                url: '/Leader/LeaderActivityAction.php',                            
                data: replyData,
                type: "POST" ,
                success: function(data){
                    var replyComment = data;
                    $(".seeReply"+cmtId).html(replyComment);                    
                  
                    $(".PostReply").click(function(){
                        event.preventDefault();
                        event.stopPropagation();
                        cmtId= $(this).attr("id");
                        postReply=$('#reply'+cmtId).val();
                        
                        replycomment='&fl=PostReply&userId=' + userId+'&cId='+cmtId+'&reply='+postReply;
                        $.ajax({
                            url: '/Leader/LeaderActivityAction.php',                            
                            data: replycomment,
                            type: "POST" ,
                            success: function(data){
                                $('#reply'+cmtId).val("");
                                getCommentLikeActivity(parameterData,rid);
                                
                            },
                            error:function(data){
                                console.log(data);
                            }
                        })
                    });

                },
                error:function(data){
                    console.log(data);
                }
            })
          
        });
          $(".comment-Edit").click(function(){
            /*here Edit Comment started */
            event.preventDefault();
            event.stopPropagation();
            editID= $(this).attr("id");
            var array = editID.split('Edit');
            cmtId= array[1];
           var editableText = $("<textarea row='17' cols='70' id='"+cmtId+"' class='updateComment"+cmtId+"'/>");
           // fill the textarea with the div's text
           editableText.val($("#comment"+cmtId).html());
           // replace the div with the textarea
           $("#comment"+cmtId).replaceWith(editableText); 
         
           $("#Edit"+cmtId).text("UPDATE");
           $("#Edit"+cmtId).attr("class", "comment-update").attr("id", cmtId);
         
        
             /*here Edit Comment Ended*/

           $(".comment-update").click(function(){
            // calling update comment under edit comment
            event.preventDefault();
            event.stopPropagation();
            cmtId= $(this).attr("id");
            var updatedComment=$(".updateComment"+cmtId).val();
            updcmtData='&fl=updateComment&userId=' + userId+'&cId='+cmtId+'&cmt='+updatedComment;

            $.ajax({
                url: '/Leader/LeaderActivityAction.php',                            
                data: updcmtData,
                type: "POST" ,
                success: function(data){
                  getPreviousCmt(parameterData,rid);
                }   
            }) 

          });

         
           
          });

         
    }
    function insertCmt(commentinsert){
        $.ajax({
            url: '/Leader/LeaderActivityMonitor.php',                            
            data: '&fl=insetCmt&cmt='+commentinsert+'&userId=' + userId+'&Id='+RowId,
            type: "POST",     
            success: function (data) {
                $('#comment').val("");
                likeCall();
                commentCall();
            }
        })
    }

});