$(document).ready(function(){
    $.ajax({ 
       type: 'GET', 
       url: '/webapi/leadermenu.php', 
       data: { get_param: 'value' }, 
       dataType: 'json',
       success: function (data) {
           var html="";
           var description ="";
           var arr = [];
        
           $.each(data, function(index, element) {
               description =element.Category;
               html+=' <a href="/Leader/Leader.php?pg='+description+'" class="lnkmenu"> '+
               '<div class="btn-menu2">'+description+'</div></a>';
           
              html+='</div>';
   
           });
   
               $('.dynamicMenu').append(html); 
       },
       error: function(error){
           console.log(error);
       }
   
   });
   });