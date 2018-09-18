function doSearch() {
    var filter = $('#searchFilter').find(":selected").text();
    var search_Data=$("#adsrch-term").val();
    var sh_data= "sh="+search_Data+"&fl="+filter;
    if(search_Data!=""){
    $.ajax({
        url: '/content/Academysearch.php', 
        type : "POST",
        data: sh_data,
        datatype: 'json',
        success: function(data) {
            $('.FilterContent').empty();                
            $('.pageContent').empty();
            $('.SearchResultDiv').empty();                
            $('.SearchResultDiv').append(data);
            $("#clearsearch").click(function(){
                var full_url = document.URL;
                $("#adsrch-term").val("");
                event.preventDefault();
                event.stopPropagation();
                window.location.href = full_url;
            });
        },
        error: function(data) {
            console.log(data);
        }
    }) 
}
}

$(document).ready(function(){
    $("#AdSearch").on('click', function(){   
        doSearch();    
    });
    
    $('div#content').find('form[name=indexSearch]').submit(function (e) {
        e.preventDefault();
        doSearch();
    });

    $('#searchFilter')  .change(function () {
        var filter = $('#searchFilter').find(":selected").text();
        var search_Data=$("#adsrch-term").val();
        var sh_data= "sh="+search_Data+"&fl="+filter;
        var full_url = document.URL;        
        var splitURL = full_url.split('?');
        var fl_data="";
        var queryString= splitURL[1];
        if(splitURL.length >1){
            fl_data= "fl="+filter+"&qu="+queryString;
            
        }
        if(splitURL.length<=1){
            fl_data= "fl="+filter;
        }
        

        if(search_Data == ""){
            $.ajax({
                url: '/content/AcademyBodyContent.php', 
                type : "POST",
                data: fl_data,
                datatype: 'json',
                success: function(data) {
                    $('.FilterContent').empty();                    
                    $('.pageContent').empty();
                    $('.SearchResultDiv').empty();                
                    $('.FilterContent').append(data);
                   
                },
                error: function(data) {
                    console.log(data);
                }
            })  
        }        
        else{
            $.ajax({
                url: '/content/Academysearch.php', 
                type : "POST",
                data: sh_data,
                datatype: 'json',
                success: function(data) {
                    
                    $('.pageContent').empty();
                    $('.FilterContent').empty();
                    $('.SearchResultDiv').empty();                
                    $('.SearchResultDiv').append(data);
                    $("#clearsearch").click(function(){
                        var full_url = document.URL;
                        $("#adsrch-term").val("");
                        event.preventDefault();
                        event.stopPropagation();
                        window.location.href = full_url;
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            })        
        }
    });
		


});