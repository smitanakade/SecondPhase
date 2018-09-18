$(document).ready(function () {
  //capturing pageID and username for each page visit
    var full_url = document.URL;
    var stuff = full_url.split('/');
    var pageId = stuff[stuff.length - 1];
    var pageCat= stuff[stuff.length -2];
    var userId = loginCheck.getUserID();
    var wdth=screen.width;    
   var hig= screen.height;
   var res=wdth+"X"+hig;
    var Data = '&PageID=' + pageId + '&UserId=' + userId + '&Flag=page&res='+res;

    $.ajax({
        url: '/content/PageComments.php',                            
        data: Data,
        type: "POST",     
        success: function (data) {
            console.log(data);
            if(data!= ""){
                 $( "#like" ).replaceWith( '<i class="fa fa-fw fa-heart faView"></i><span class="faActionText">LIKED&nbsp;&nbsp;&nbsp;&nbsp;</span>' );
                 

            }
  //Calling activitySection.js file which will load number of views,comment and reply activity
       //Beause to get the correct number of views ContentPage.js is inserting user view in to table and activitySection.js will fetch number of user 
       $.ajax({
                dataType: 'script',
                url: '/dynamic/js/activitySection.js',
                crossDomain:true,
                success: function(response)
                {
                    //Whatever
                }
            })
        },
        error: function (data) {
            console.log(data);
        }
    });

 
    var recod='&PageID=' + pageId + '&UserId=' + userId + '&Flag=unload&pgCat='+pageCat;
    $(window).unload(function() {
         $.ajax({
            url: "/content/PageComments.php",
            type: "POST",
            data: recod,
            async : false,
               
        }); 
});

   
});

  