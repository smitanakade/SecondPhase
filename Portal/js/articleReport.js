$(document).ready(function () {
    $('#generatereport').click(function () {
        var reportName = $('#reportname').val();
        var site = $('#site').val();
       
        var Data = '&ReportType=' + $('#reportname').val() + '&StartDate=' + $('#startdate').val() + '&EndDate=' + $('#enddate').val() + '&Location=' + $('#location').val() + '&Department=' + $('#department').val() + '&Site=' + $('#site').val();
        $.ajax({
            url: '/Portal/ArticleExportReports.php',
            data: Data,
            type: "POST",
            success: function (response) {
                $("#report").html('');
                $("#rowsnotfound").html('')
                var result = $.parseJSON(response);
                if (result.length > 0) {
                    if (site == 'all') {
                        if (reportName == 'like') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th> <th>Category</th><th>sub category</th><th>third category</th> <th>Number of Likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['pagelike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'comments') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th> <th>main category</th><th>sub category</th><th>third category</th> <th>No Of comments</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['Comments'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (reportName == 'commentslike') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th> <th>Category</th><th>sub category</th><th>third category</th> <th>No of comment likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['NoofCommentslike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }

                        else if (reportName == 'pageview') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th><th>main category</th><th>sub category</th><th>third category</th> <th>PageViews</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['pageViews'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (reportName == 'useractivity') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>EmployeeId</th> <th>NameReport</th> <th>location</th><th>ViewedDate</th><th>InTime</th><th>OutTime</th><th>Duration</th><th>Department</th><th>PageViewed</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['EmployeeId'] + '</td> <td>'
                                    + value['NameReport'] + '</td> <td> '
                                    + value['location'] + '</td> <td>'
                                    + value['ViewedDate'] + '</td><td>'
                                    + value['InTime'] + '</td><td>'
                                    + value['OutTime'] + '</td><td>'
                                    + value['Duration'] + '</td><td>'
                                    + value['Department'] + '</td><td>'
                                    + value['PageViewed'] + '</td><tr>';
                            });
                            string += '</table>';


                            $("#report").html(string);
                        }
                        else if (reportName == 'articlepagelike') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Number of Likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['pagelike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'articlecomments') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Comments</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['Comments'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                    } else if (site == 'leader')  {
                        if (reportName == 'like') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Number of Likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['pagelike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'comments') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Comments</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['Comments'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (reportName == 'commentslike') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th> <th>Category</th> <th>No of Comment likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['NoofCommentslike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (site == 'leader' && reportName == 'pageview') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Title</th> <th>Category</th> <th>PageViews</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['pageViews'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (site == 'leader' && reportName == 'useractivity') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>EmployeeId</th> <th>NameReport</th> <th>location</th><th>ViewedDate</th><th>InTime</th><th>OutTime</th><th>Duration</th><th>Department</th><th>PageViewed</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['EmployeeId'] + '</td> <td>'
                                    + value['NameReport'] + '</td> <td> '
                                    + value['location'] + '</td> <td>'
                                    + value['ViewedDate'] + '</td><td>'
                                    + value['InTime'] + '</td><td>'
                                    + value['OutTime'] + '</td><td>'
                                    + value['Duration'] + '</td><td>'
                                    + value['Department'] + '</td><td>'
                                    + value['PageViewed'] + '</td><tr>';
                            });
                            string += '</table>';


                            $("#report").html(string);
                        }
                      else  if (reportName == 'articlepagelike') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Number of Likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['pagelike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'articlecomments') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Comments</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['Comments'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                   
                    } else if (site == 'academy') {
                        if (reportName == 'like') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th> <th>main category</th><th>sub category</th><th>third category</th> <th>Number of Likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['maincategory'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['pagelike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'comments') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th> <th>main category</th><th>sub category</th><th>third category</th> <th>No Of comments</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['maincategory'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['comments'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'commentslike') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th><th>main category</th><th>sub category</th><th>third category</th><th>No of Comments like</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['maincategory'] + '</td> <td> '
                                    + value['subcategory'] + '</td> <td> '
                                    + value['thirdcategory'] + '</td> <td> '
                                    + value['NoofCommentslike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (reportName == 'pageview') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Page Title</th><th>main category</th><th>sub category</th><th>third category</th> <th>PageViews</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['PageTitle'] + '</td> <td>'
                                    + value['maincategory'] + '</td> <td> '
                                    + value['subcategory'] + '</td><td> '
                                    + value['thirdcategory'] + '</td><td> '
                                    + value['pageViews'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                        else if (reportName == 'useractivity') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>EmployeeId</th> <th>NameReport</th> <th>location</th><th>ViewedDate</th><th>InTime</th><th>OutTime</th><th>Department</th><th>PageViewed</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['EmployeeId'] + '</td> <td>'
                                    + value['NameReport'] + '</td> <td> '
                                    + value['location'] + '</td> <td>'
                                    + value['ViewedDate'] + '</td><td>'
                                    + value['InTime'] + '</td><td>'
                                    + value['OutTime'] + '</td><td>'
                                    + value['Department'] + '</td><td>'
                                    + value['PageViewed'] + '</td><tr>';
                            });
                            string += '</table>';


                            $("#report").html(string);
                        }
                        else if (reportName == 'articlepagelike') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Number of Likes</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['pagelike'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        } else if (reportName == 'articlecomments') {
                            var string = '<table class="table table-bordered table-hover"><thead><th>Activity Title</th> <th>Category</th> <th>Comments</th></thead >';

                            /* from result create a string of data and append to the div */

                            $.each(result, function (key, value) {
                                string += '<tr><td>' + value['Title'] + '</td> <td>'
                                    + value['Category'] + '</td> <td> '
                                    + value['Comments'] + '</td><tr>';
                            });
                            string += '</table>';

                            $("#report").html(string);
                        }
                    } 
                }

                else {
                    $("#rowsnotfound").html('Data not found')
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
 

});