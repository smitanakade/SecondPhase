$(document).ready(function () {
  //capturing pageID and username for each page visit
    var full_url = document.URL;
    var stuff = full_url.split('/');
    var pageId = stuff[stuff.length - 1];
    var pageCat= stuff[stuff.length -2];
    var userId = loginCheck.getUserID();
    var uriParameters = location.search.substr(1).split('&');
    
       for (var i = 0; i < uriParameters.length; i++) {
         var parameter = uriParameters[i].split('=');
       }


    var Data = '&PageID=' + pageId + '&UserId=' + userId + '&Flag=page';

    $.ajax({
        url: '/Leader/PageComments.php',                            
        data: Data,
        type: "POST",     
        success: function (data) {  
            if(data!=""){
                $( "#like" ).replaceWith( '<i class="fa fa-fw fa-heart faView"></i><span class="faActionText">LIKED&nbsp;&nbsp;&nbsp;&nbsp;</span>' );
            }
       //Calling activitySection.js file which will load number of views,comment and reply activity
       //Beause to get the correct number of views ContentPage.js is inserting user view in to table and activitySection.js will fetch number of user 
            $.ajax({
                dataType: 'script',
                url: '/Leader/assets/js/activitySection.js',
                crossDomain:true,
                success: function(response)
                {
                    
                }
            })
        },
        error: function (data) {
            console.log(data);
        }
    });
    

    function ajaxCall(postData) {
        $.ajax({
            url: "/Leader/PageComments.php",
            type: "POST",
            data: postData,
            success: function (data) {
                var obj=jQuery.parseJSON(data);
                $('#pagelike').remove();
                html='<span id="pagelike">'+obj.pagelike+'</span>';
              $('#totalLike').append(html); 
              $('#btnlike').css('class',"btn btn-default btn-sm");  
             if(obj.rating !=0){
              $('input:radio[class=rating-input][id=rating-input-1-'+obj.rating+']').prop('checked', true);
             }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    var recod='&PageID=' + pageId + '&UserId=' + userId + '&Flag=unload&pgCat='+pageCat;
    $(window).unload(function() {
         $.ajax({
            url: "/Leader/PageComments.php",
            type: "POST",
            data: recod,
            async : false,
               
        }); 
});

   
});

  