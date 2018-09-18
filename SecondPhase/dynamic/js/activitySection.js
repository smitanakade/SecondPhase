$(document).ready(function(){
    var full_url = document.URL;
    var stuff = full_url.split('/');
    var pageId = stuff[stuff.length - 1];
    var userId = loginCheck.getUserID();
    var Data = '&PageID=' + pageId ;
    var commentsHtml="";
    likeCall();
    commentCall();
    commentEdit();
    commentLike();
    replycomment();
    var menu ="";

    
    function likeCall(){
    //below ajax call getting page total view like and comment count 
    $.ajax({
        url: '/content/AcademyComment.php',                            
        data: '&PageID=' + pageId+'&fl=like',
        type: "POST",     
        success: function (data) {
            $("#pgActivity").html(data);
            
        }
    });
}

function replycomment() {
    $(".comment-SeeReply").click(function(){
        $('.comment-SeeReply').each(function () {
            var replyid=this.id;

            var getText=  $('#'+replyid).text();  
            if(getText=='HIDE REPLIES'){
                $("#"+replyid).text('SHOW REPLIES');
            }                     
        });
        event.preventDefault();
        event.stopPropagation();
        var cmtId="";
        var cmId ="";
       var Cid= $(this).attr("id");
        if(Cid.match("replyshow")){
            var cmId = Cid.split("replyshow");
            cmtId =cmId[1];
        }else{
            cmtId=$(this).attr("id");
        }
        
        if($("#replyBox"+cmtId).css("display") == "none")
        {
            $('.replyBox').css("display","none");  
            $("#replyshow"+cmtId).text('HIDE REPLIES');                        
            
            $("#replyBox"+cmtId).show();
            
        }else
        {
            $('.replyBox').css("display","none");
            $("#replyshow"+cmtId).text('SHOW REPLIES');            
            
        } 
        
        replyData='&fl=getReply&userId=' + userId+'&cId='+cmtId;
        
        $.ajax({
            url: '/content/AcademyCmtAction.php',                            
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
                        url: '/content/AcademyCmtAction.php',                            
                        data: replycomment,
                        type: "POST" ,
                        success: function(data){
                            $('#reply'+cmtId).val("");
                            $.ajax({
                                url: '/content/AcademyCmtAction.php',                            
                                data: replyData,
                                type: "POST" ,
                                success: function(data){
                                    var replyComment = data;
                                    $(".seeReply"+cmtId).html(replyComment);   
                                }
                            });

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
}

function commentLike(){
    $(".comment-like1").click(function () {
        //start here comment like code 
          event.preventDefault();
          event.stopPropagation();
          cmtId= $(this).attr("id");

          cmtData='&fl=cmtLike&userId=' + userId+'&cId='+cmtId;
          $.ajax({
              url: '/content/AcademyCmtAction.php',                            
              data: cmtData,
              type: "POST" ,
              success: function(){
                likeCall();
                commentCall();
                commentEdit();
                commentLike();
                replycomment();
                //after comment like updated fetching updated result
                $.ajax({
                    url: '/content/AcademyComment.php',                            
                    data: '&PageID=' + pageId+'&fl=comment&userId='+userId,
                    type: "POST", 
                    success: function (data) {
                        commentsHtml=data;
                        $("#listComments").html(commentsHtml);
                        likeCall();
                        commentCall();
                        commentEdit();
                        replycomment();
                    }
                });


            }   
          })
      });
}
function commentEdit(params) {
    $(".comment-Edit").click(function(){
        /*here Edit Comment started */
        event.preventDefault();
        event.stopPropagation();
        $('.replyBox').css("display","none");        
        editID= $(this).attr("id");
        var array = editID.split('Edit');
        cmtId= array[1];
       var editableText = $("<textarea row='17'style='background: #eee;' cols='70' id='"+cmtId+"' class='updateComment"+cmtId+"'/>");
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
            url: '/content/AcademyCmtAction.php',                            
            data: updcmtData,
            type: "POST" ,
            success: function(data){
                likeCall();
                commentCall();
                commentLike();                     //after comment edit updated fetching updated result
                replycomment();
            }   
        }) 

      });

     
       
      });
}
function commentCall() {    
   //below ajax call getting page comment 
    $.ajax({
        url: '/content/AcademyComment.php',                            
        data: '&PageID=' + pageId+'&fl=comment&userId='+userId,
        type: "POST",     
        success: function (data) {
                commentsHtml=data;
                $("#listComments").html(commentsHtml);
                likeCall();
                commentEdit();
                commentLike();                     
                replycomment();
        }
    })
}

function insertCmt(commentinsert){
    $.ajax({
        url: '/content/AcademyComment.php',                            
        data: '&PageID=' + pageId+'&fl=insetCmt&Id='+userId+'&cmt='+commentinsert,
        type: "POST",     
        success: function (data) {
            $('#comment').val("");
            likeCall();
            commentCall();
            commentEdit();
            commentLike();
            replycomment();
        }
    })
}
function pgLike(){
    $.ajax({
        url: '/content/AcademyComment.php',                            
        data: '&PageID=' + pageId+'&fl=pgLike&Id='+userId,
        type: "POST",     
        success: function (data) {
            likeCall();
            commentCall();
            commentEdit();
            commentLike();
            replycomment();
            $( "#like" ).replaceWith( '<i class="fa fa-fw fa-heart faView"></i><span class="faActionText">LIKED&nbsp;&nbsp;&nbsp;&nbsp;</span>' );
            
        }
    })
}
    
    $("#addComment").click(function () {
        $('#divAddComment').slideToggle();
        $('#listComments').slideToggle();
        //$("#listComments").html(commentsHtml);
       $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        
        return false;
    });

    $("#like").click(function () {
        pgLike();
        return false;
    });

    $("#postComment").click(function () {
        if ($('#comment').val().length < 5){
            alert('You must enter at least 5 characters');
        }
        if ($('#comment').val().length > 5){
            var commentinsert=$('#comment').val();
            insertCmt(commentinsert)
        }
        return false;
    });


    // commentHtml should come from the server


    /* $(".comment-like").click(function () {
        alert('Comment liked ' + $(this).attr("id"));
        console.log($(this));
        return false;
    }); */

    $('#customComponent').slideToggle();
    $('#divAddComment').slideToggle();
    $('#listComments').slideToggle();


});