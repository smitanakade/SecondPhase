function doLeaderSearch() {
    var search_Data = $("#homeSearch").val();
    var uriParameters = location.search.substr(1).split('&');
    var pg = uriParameters[0];
    var urldata = "";
    if (pg) {
        urldata = '/Leader/getSearchResult.php?' + pg;
    } else {
        urldata = '/Leader/getSearchResult.php';
    }
    if (search_Data != "") {
        $.ajax({
            url: urldata,
            type: "POST",
            data: {
                search: search_Data//$("#homeSearch").val()
            },
            datatype: 'json',
            success: function (data) {
                //   var obj = jQuery.parseJSON(data);
                //    console.log(data);
                $("#homeSearch").val('');
                $('#filterResult').empty();
                $('.SearchResultDiv').empty();
                $('.SearchResultDiv').append(data);
                $("#clearsearch").click(function () {
                    var full_url = document.URL;
                    $("#adsrch-term").val("");
                    event.preventDefault();
                    event.stopPropagation();
                    window.location.href = full_url;
                });
            },
            error: function (data) {
                console.log(data);
            }
        })
    }
}

$(document).ready(function () {
    $("#homeSearchbtn").on('click', function () {
        doLeaderSearch();
    });
    $('div#content').find('form[name=indexSearch]').submit(function (e) {
        e.preventDefault();
        doLeaderSearch();
    });
});