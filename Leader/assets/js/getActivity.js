$(document).ready(function(){
    var full_url = document.URL;  
    var stuff = full_url.split('/');
    var pageId = stuff[stuff.length - 1];
    var userId = loginCheck.getUserID();
    var Data = '&PageID='+pageId+'&UserId=' + userId + '&Flag=Like';
        $.ajax({
            url: '/Leader/getActivity.php', 
            type : "POST",
            data: Data,
            datatype: 'json',
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                
            console.log(obj.TotalLike);
            html='<span>'+obj.TotalLike+'</span>';
            $('#totalLike').append(html);                                           
            },
            error:function(data){
                console.log(data);
            }
        })
    });