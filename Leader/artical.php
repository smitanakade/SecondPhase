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

    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/Leader/assets/css/styles_layers.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/styles_resp.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/fonts.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/scroll.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/jquery.swipeshow.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/slideshow-theme.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/assets/css/forms_light.css" rel="stylesheet" type="text/css" media="all" charset="utf-8"/>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Leader/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <?php //include_once("dbconnect.php");?>

    <?php // include_once("analyticstracking.php") ?>


</head>

<body onresize="resize(),slidersize()" onload="resize(),slidersize()">

<div class="menustatus"></div>

<div id="mainmenu" align="left">
    <div class="btn-menu" style="padding:0px 0px 10px 0px;border:0px;">
        <a href="mailto:myeracademy@myer.com.au" class="lnkmenu">
            <img src="/assets/images/icon-email.png" style="margin:0px 10px 0px -4px;display:inline-block;border:0px"
                 align="absmiddle">
        </a>
        <a href="index.html"
           class="lnkmenu">
            <img src="/assets/images/icon_myer.png" style="margin:0px 10px 0px 0px;display:inline-block;border:0px"
                 align="absmiddle">
        </a>
        <img src="/assets/images/icon-info.png" style="margin:0px;display:inline-block;" align="absmiddle"
             onclick="scrolltoabout(),openmenu()" class="pointer">
        <img src="/assets/images/icon-logout.png" style="margin:0px 10px;display:inline-block;cursor: pointer"
             align="absmiddle" onclick="logout()">
        <br>

    </div>
    <div class="scrollcontainer scrollheight2">
        <div class="scrollpanel">
            <div id="mainmenuinner" style="max-width:1200px;width:100%">
                <div class="btn-menu"
                     style="color:rgba(255,255,255,1);padding:18px 0px 18px 20px;border:0px;background:url('/assets/images/bullet-off.png') no-repeat left center;cursor:pointer;"
                     onclick="scrolltoabout(),openmenu()">ABOUT MYER ACADEMY
                </div>
                <br>

                 <a href="/content/add-on-selling/index.html" class="lnkmenu">
                    <div class="btn-menu2">ADD ON SELLING</div>
                </a>
                <a href="/content/are-you-listening/index.html" class="lnkmenu">
                    <div class="btn-menu2">ARE YOU LISTENING?</div>
                </a>
                <a href="/content/asilio/index.html" class="lnkmenu">
                    <div class="btn-menu2">ASILIO</div>
                </a>
                <a href="/content/basque/index.html" class="lnkmenu">
                    <div class="btn-menu2">BASQUE</div>
                </a>
                <a href="/content/blaq/index.html" class="lnkmenu">
                    <div class="btn-menu2">BLAQ</div>
                </a>
                <a href="/content/bra-fitting-etiquette/index.html" class="lnkmenu">
                        <div class="btn-menu2">BRA FITTING ETIQUETTE</div>
                </a>
                <a href="/content/breast-anatomy-and-bra-construction/index.html" class="lnkmenu">
                        <div class="btn-menu2">BREAST ANATOMY AND BRA CONSTRUCTION</div>
                </a>
                <a href="/content/building-rapport-credibility/index.html" class="lnkmenu">
                    <div class="btn-menu2">BUILDING RAPPORT &amp; CREDIBILITY</div>
                </a>
                <a href="/content/your_personal_brand/index.html" class="lnkmenu">
                    <div class="btn-menu2">BUILDING YOUR PERSONAL BRAND</div>
                </a>
                <a href="/content/christmas-trim/index.html" class="lnkmenu">
                    <div class="btn-menu2">CHRISTMAS TRIM</div>
                </a>
                <a href="/content/choosing-the-right-bra/index.html" class="lnkmenu">
                    <div class="btn-menu2">CHOOSING THE RIGHT BRA</div>
                </a>
                <a href="/content/classic-footwear-brands/index.html" class="lnkmenu">
                    <div class="btn-menu2">CLASSIC FOOTWEAR BRANDS</div>
                </a>     
                <a href="/content/commbank/index.html" class="lnkmenu">
                    <div class="btn-menu2">COMMBANK AWARDS POINTS</div>
                </a>
                <a href="/content/converting-sales/index.html" class="lnkmenu">
                    <div class="btn-menu2">CONVERTING SALES</div>
                </a>
                <a href="/content/cooper-street/index.html" class="lnkmenu">
                    <div class="btn-menu2">COOPER STREET</div>
                </a>
                <a href="/content/delight/index.html" class="lnkmenu">
                    <div class="btn-menu2">DELIGHT</div>
                </a>
                <a href="/content/denimmen/index.html" class="lnkmenu">
                    <div class="btn-menu2">DENIM FOR MEN</div>
                </a>
                <a href="/content/denimwomen/index.html" class="lnkmenu">
                    <div class="btn-menu2">DENIM FOR WOMEN</div>
                </a>
                <a href="/content/fitting-a-bra/index.html" class="lnkmenu">
                    <div class="btn-menu2">FITTING A BRA</div>
                </a>
                <a href="/content/construction/index.html" class="lnkmenu">
                    <div class="btn-menu2">FOOTWEAR CONSTRUCTION</div>
                </a>
                <a href="/content/sizes_trends/index.html" class="lnkmenu">
                    <div class="btn-menu2">FOOTWEAR SIZES &amp; TRENDS</div>
                </a>
                <a href="/content/give_registry/index.html" class="lnkmenu">
                    <div class="btn-menu2">GIVE REGISTRY</div>
                </a>
                <a href="/content/growth-mindset/index.html" class="lnkmenu">
                    <div class="btn-menu2">GROWTH MINDSET</div>
                </a>
                <a href="/content/howwebuy/index.html" class="lnkmenu">
                    <div class="btn-menu2">HOW WE BUY</div>
                </a>
                <a href="/content/howwelearn/index.html" class="lnkmenu">
                    <div class="btn-menu2">HOW WE LEARN AT MYER</div>
                </a>
                <a href="/content/intimate-apparel-care-and-solutions/index.html" class="lnkmenu">
                    <div class="btn-menu2">INTIMATE APPAREL CARE AND SOLUTIONS</div>
                </a>
                <a href="/content/intro-to-shrinkage/index.html" class="lnkmenu">
                    <div class="btn-menu2">INTRODUCTION TO SHRINKAGE AT MYER</div>
                </a>
                <a href="/content/jack_jones/index.html" class="lnkmenu">
                    <div class="btn-menu2">JACK &amp; JONES</div>
                </a>
                <a href="/content/kenji/index.html" class="lnkmenu">
                    <div class="btn-menu2">KENJI</div>
                </a>
                <a href="/content/leona-by-leona-edmiston/index.html" class="lnkmenu">
                    <div class="btn-menu2">LEONA BY LEONA EDMISTON</div>
                </a>
                <a href="/content/myer-credit-card/index.html" class="lnkmenu">
                    <div class="btn-menu2">MYER CREDIT CARD</div>
                </a> 
                <a href="/content/on-trend/index.html" class="lnkmenu">
                    <div class="btn-menu2">ON TREND FOR SPRING RACING</div>
                </a>                
                <a href="/content/piper/index.html" class="lnkmenu">
                    <div class="btn-menu2">PIPER</div>
                </a>
                <a href="/content/race-day-outfits/index.html" class="lnkmenu">
                    <div class="btn-menu2">RACE DAY OUTFITS</div>
                </a>
                <a href="/content/reserve/index.html" class="lnkmenu">
                    <div class="btn-menu2">RESERVE</div>
                </a>
                <a href="/content/denimcare/index.html" class="lnkmenu">
                    <div class="btn-menu2">RULES OF DENIM CARE</div>
                </a>
                <a href="/content/sales-metrics/index.html" class="lnkmenu">
                    <div class="btn-menu2">SALES METRICS</div>
                </a>
                <a href="/content/stella/index.html" class="lnkmenu">
                    <div class="btn-menu2 btn-bord-bot">STELLA</div>
                </a>
                <a href="/content/styling-with-colour/index.html" class="lnkmenu">
                    <div class="btn-menu2 btn-bord-bot">STYLING WITH COLOR</div>
                </a>
                <a href="/content/styling-with-neutrals/index.html" class="lnkmenu">
                    <div class="btn-menu2 btn-bord-bot">STYLING WITH NEUTRALS</div>
                </a>
                <a href="/content/the-bra-wardrobe/index.html" class="lnkmenu">
                    <div class="btn-menu2 btn-bord-bot">THE BRA WARDROBE</div>
                </a>
                <a href="/content/wayne_cooper/index.html" class="lnkmenu">
                    <div class="btn-menu2 btn-bord-bot">WAYNE COOPER</div>
                </a>
                <a href="/content/youngandcontemporary/index.html" class="lnkmenu">
                    <div class="btn-menu2 btn-bord-bot">YOUNG &amp; CONTEMPORARY FOOTWEAR</div>
                </a>
            </div>
        </div>
    </div>
    <div style="width:100%;max-width:1200px;height:35px;margin-top:10px;display:block;background:rgba(156,156,156,0);cursor:pointer"
         align="center" onclick="openmenu()"><img src="/assets/images/arrow_up2.png"
                                                  style="margin:5px 0px 0px 0px;cursor:pointer;width:55px"></div>


</div>


<div class="menu pointer" align="center" onclick="openmenu()">
    <img src="/assets/images/hamburger.png" style="width:26px;float:left;margin:13px 0px 0px 10px">
    <img src="/assets/images/592fabe4ab4951b364eb10eb.jpeg" class="logo-myeracademy2">
</div>


<div align="center">
<div style="font-family: 'aperculight';font-size:12px;line-height:2px;padding:40px 20px 0px 20px;max-width:768px;">
            <span style="font-family: 'MillerBanner-Roman';font-size:22px;line-height:2px;text-transform:uppercase">MYER LEADERS PORTAL</span>
            <div class="spacer20"></div>
           REALISE YOUR LEADERSHIP POTENTIAL
            <div class="spacer50"></div>
        </div>
        <form class="navbar-form" id="indexSearch" method="POST" name="indexSearch" >
    <div class="input-group add-on">
      <input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. CHANGE" name="srch-term" id="srch-term" type="text">
      <div class="input-group-btn">
        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
      </div>
    </div>
    
  </form>
    <div id="content">
   
<?php 
 //   $sql_query="SELECT pageId,PageTitle,subTitle,pageDescription,articalFolder,ImageName,keyword,m.CategorieDescription as mainDescription, sm.smDescription as SubMain, sm.smid,  th.thLid,th.thlDescription as thlGroup,s.MainCatId FROM leaderartical as s LEFT JOIN Submaincategory as sm on s.smId = sm.smid LEFT JOIN maincategories as m on s.MainCatId= m.Id LEFT JOIN thirdlevelgroup as th on s.thLid = th.thLid ORDER BY PageRanking ";
    //$result = mysqli_query($link,$sql_query);
   // while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
        
?>

        <div align="center" style="padding:25px 8px;background:#f5f5f5">
       <div style="">
        <span style="font-family: 'MillerBanner-Roman';font-size:22px;line-height:2px;text-transform:uppercase; margin:10px;">What am I doing today?</span>
   </div>
            <div style="max-width:1600px;">
    <!--         <a href="myer-credit-card/index.html"><div class="tilewrap" style="background-image: url(/assets/images/slider01.jpg); height: 401.5px;">
                    <div class="tileinner">
                        <div class="tile-valign">
                            <div class="spacer60"></div>
                            <div class="logowrap" align="center">
                                <div class="hd-tile">MYER CREDIT CARD</div>
                                <span class="txt-tile">Introducing the new Myer Credit Card</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>  -->
            <div style="background-color:#FFF;max-width:100%;">
                <div style="overflow: auto;zoom: 1;background-color:#FFF; margin: 20px 15px 12px 25px;">

                    <img src="/Leader/assets/images/sale.jpeg" style="float:left; max-width:50%;">
                    <div class="logowrap" align="center">
                                <div style="font-size: 22px;line-height: 26px;padding: 5px 0px;color: #000;">MYER CREDIT CARD</div>
                                <span style="color:#000;box-sizing: border-box;">Introducing the new Myer Credit Card</span>
                            </div>
                </div>
                    <div style="margin:auto 0;padding:7px;"> 
                    <span style="margin:15px;"><img src="/Leader/assets/images/chat.png"  style="width:70px;height:70px;"></span>  <span style="margin:15px;"><img src="/Leader/assets/images/chat.png"  style="width:70px;height:70px;"></span>  <span style="margin:15px;"><img src="/Leader/assets/images/chat.png"  style="width:70px;height:70px;"></span><br/>
                    <span style="margin:5px;">Keyword1</span>|<span style="margin:5px;">Keyword1</span>|<span style="margin:5px;">Keyword1</span>|<span style="margin:5px;">Keyword1</span></div> 
   </div>
              </div>
        </div>
        

        <div id="footer">
            &copy 2016 www.academy.com.au<br><br>
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

<script>

    var loginCheck = new StaffLogin(loginConfig);
    loginCheck.checkIfLoggedIn(function (isLoggedIn) {
        if (isLoggedIn) {
            showPage();
        } else {
            redirect();
        }
    })

    $(document).ready(function () {
        $(this).scroll(function () {
            var pagew = window.innerWidth;
            var sheight = $(window).scrollTop();
            if (sheight >= 300) {
                $('.menu').css("background", "rgb(255, 255, 255)");
                $('.menu').css("box-shadow", "0px 0px 15px rgba(0,0,0,.7)");
                $('.logo-myeracademy2').css("opacity", "1");
            }

            else {
                $('.menu').css("background", "rgba(0,0,0,0)");
                $('.logo-myeracademy2').css("opacity", "0");
                $('.menu').css("box-shadow", "0px 0px 15px rgba(0,0,0,0)")
            }

            if (sheight >= 150) {
                if (pagew <= 640) {

                    $('.menu').css("background", "rgb(255, 255, 255)");
                    $('.menu').css("box-shadow", "0px 0px 15px rgba(0,0,0,.7)");
                    $('.logo-myeracademy2').css("opacity", "1");
                }
            }
        });
    });

    $(window).load(function () {

        $('.logo-myeracademy').css("transform", "scale(1.00)");
        $('.logo-myeracademy').css("opacity", "1");
    });

    function showPage() {
        $('#content').fadeTo(500, 1);
        $('.logo-myeracademy').css("transform", "scale(1.00)");
        $('.logo-myeracademy').css("opacity", "1");
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
