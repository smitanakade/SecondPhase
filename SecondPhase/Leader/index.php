<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="-"/>
    <meta name="keywords" content="-"/>
    <meta name="format-detection" content="telephone=no">
    <title>Myer Academy</title>
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/styles_layers.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/styles_resp.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/fonts.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/scroll.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/jquery.swipeshow.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/slideshow-theme.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/forms_light.css" rel="stylesheet" type="text/css" media="all" charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles_learningmomentsMenu.css">
    


    <!-- other files-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="/dynamic/js/jquery-1.10.2.js" type="text/javascript" ></script>
    <script src="/dynamic/js/jquery-2.1.3.min.js" type="text/javascript" ></script>
    <link href="/dynamic/css/comments.css" type="text/css" rel="stylesheet" />
     <link href="/dynamic/css/menu.css" rel="stylesheet" type="text/css" />
   <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" media="all" />
   <link href="/dynamic/css/comments.css" rel="stylesheet" type="text/css" />
   <script src="/Leader/assets/js/Leadersearch.js"></script>
   
   <link href="/dynamic/css/styles_resp.css" rel="stylesheet" type="text/css" media="all" />

<?php include_once("db_connect.php");?>

</head>

<body onresize="resize(),slidersize()" onload="resize(),slidersize()">

     <!-- dynamicMenu here adding menu dynamically -->
     <div class="dynamicMenu">
        </div>
               <!-- dynamicMenu here adding menu dynamically -->

<div align="center">
    <div id="content">

    
        <!-- INTRO -->
        <div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
             id="myeracademywelcome"></div>
             <div id="ddddd" style="max-width:100%;min-height:70px;"><img src="/Leader/assets/images/592fabe4ab4951b364eb10eb.jpeg" ></div>

        <div style="font-family: 'aperculight';font-size:17px;line-height:24px;padding:8px 20px 0px 20px;max-width:768px;">
            <div class="beforeTopHeader">
                    <span   class="headLine">MYER LEADERS PORTAL</span>
                <h2  class="subtitle">OWN YOUR LEADERSHIP POTENTIAL</h2>
            </div>
              <!-- // Hero -->
        <div class="spacer20"></div>
        <span class="headLine3">What am I doing today ?</span>
        <div class="spacer20"></div>
        <p class="subtitle"style="max-width: 700px;">SEARCH FOR A SPECIFIC TOPIC OR CLICK ONE OF THE FOUR LEADERSHIP FOCUS AREAS TO DISCOVER MORE
</p>
        <div class="spacer20"></div>
            <!--This Page body search option code -->
            <form  id="indexSearch" method="POST" name="indexSearch" action="/Leader/searchResult.php" >

                    <div>
                        <div class="input-group add-on">
                            <input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. CHANGE" name="homeSearch" id="homeSearch" type="text">
                            <div class="input-group-btn">
                                    <button class="btn btn-default" id="homeSearchbtn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
            </form>

        </div>
        <!-- // INTRO -->
    
    
        <div align="center" style="padding:25px 8px;">


<!-- SearchResultDiv will show search result dynamically start here added -->
<div class="SearchResultDiv" id="SearchResultDiv"></div>
<!-- SearchResultDiv will show search result dynamically End here added -->



            <div style="max-width:1600px;">
            <div style="max-width:1600px;">
                <a href="/Leader/Leader.php?pg=LEADING SELF" >
                    <div  class="LeaderHome">
                        <img src="/Leader/assets/images/LEADINGSELF.jpg" style="max-width:100%;">
                    </div>
                </a> 
                <a href="/Leader/Leader.php?pg=LEADING OTHERS">
                    <div  class="LeaderHome">
                        <img src="/Leader/assets/images/LEADINGOTHERS.jpg" style="max-width:100%;">
                    </div>  
                </a> 
                <a href="/Leader/Leader.php?pg=WORKING ON THE BUSINESS">
                    <div  class="LeaderHome">
                        <img src="/Leader/assets/images/WORKINGONTHEBUSINESS.jpg" style="max-width:100%;">
                    </div>
                </a> 
                <a href="/Leader/Leader.php?pg=WORKING IN THE BUSINESS">
                    <div  class="LeaderHome">
                        <img src="/Leader/assets/images/WORKINGINTHEBUSINESS.jpg" style="max-width:100%;">
                    </div>
                </a> 
                
             
              </div>
            </div>
        </div>
        <div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
             id="myeracademyabout"></div>
          
        <div id="footer">
            &copy 2016 www.myeracademy.com.au<br><br>
            <img src="/assets/images/arrow_up.png" style="margin:20px 0px" class="pointer" onclick="scrolltotop()">
        </div>


    </div>
</div>

<script type="application/javascript" src="/assets/js/config.js"></script>
<script type="text/javascript" src="/assets/js/functions.js"></script>
<script type="text/javascript" src="/assets/js/jquery-2.1.3.min.js"></script>
<script src="/assets/js/jquery.swipeshow.min.js"></script>
<script type="application/javascript" src="/assets/js/es6-promise-polyfill.js"></script>
<script type="application/javascript" src="/assets/js/axios.js"></script>
<script type="application/javascript" src="/assets/js/stafflogin.js"></script>
<script src="/assets/js/main.js" type="text/javascript" language="javascript"></script>

<script>


    var loginCheck = new StaffLogin(loginConfig);
     loginCheck.checkIfLoggedIn(function (isLoggedIn) {
         if (isLoggedIn) {
             showPage();
         } else {
             redirect();
        }
    })


    $(window).load(function () {
        $('.logo-myeracademy2').css("transform", "scale(1.00)");
        $('.logo-myeracademy2').css("opacity", "1");
    });

    function showPage() {
        $('#content').fadeTo(500, 1);
       
        var mainmenuh = $('#mainmenu').height();
        var mainmenuh2 = 0 - mainmenuh - 110;
        $('#mainmenu').css("margin-top", mainmenuh2);

        if (window.location.hash) {
            $('.tab1 .tabinner3').fadeTo(0, '0');
            var hash = window.location.hash;
            if (hash == '#about') {
                scrolltoabout();
            }
        }
    }
    $(document).ready(function () {
        $.ajax({ 
       url: '/content/menu.php', 
       success: function (data) {
        $(".dynamicMenu").html(data);
		initMenu();
        $(this).scroll(function () {
            scrollPage();

        });

       },
       error :function(data){
           console.log(data);
       }
    });
		
    });
    function redirect() {
        document.location.href = '/index.html';
    }


    function logout() {
        loginCheck.logout();
        redirect();
    }

    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-85609472-1', 'auto');
    ga('send', 'pageview');

    (function ($) {
        $(".version").text($.swipeshow.version);
        $(".slideshow").swipeshow({autostart: true, mouse: true, interval: 6000});
    })(jQuery);
</script>

</body>
</html>
