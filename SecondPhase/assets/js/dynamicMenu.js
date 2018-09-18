$(document).ready(function(){
    $.ajax({ 
       type: 'GET', 
       url: 'http://localhost/myer/webapi/content.php', 
       data: { get_param: 'value' }, 
       dataType: 'json',
       success: function (data) {
           var html="";
           var description ="";
           var arr = [];
          
           $.each(data, function(index, element) {
               description =element.CategorieDescription;
               html+=' <div class="btn-menu2"> '+
               '<div class="btn-menu">'+description+'</div>';
             if(element.sub ){
               $.each(element.sub,function(k,v){
                    html+='<div id="btn-menu"><a href="index.php?sec=sm'+v.smId+'" class="lnkmenu">'+ v.subDescription+'</a></div>'
                   if(v.third){
                       $.each(v.third,function(a,j){
                           html+='<div id="submenu"><a href="index.php?sec=lm'+j.thLid+'" class="lnkmenu">'+ j.thlDescription+'</a></div>'
   
                       });
                   }
                  });
               }
              html+='</div>';
   
           });
   
               $('.dynamicMenu').append(html); 
       },
       error: function(error){
           console.log(error);
       }
   
   });
   });