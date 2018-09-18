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
   <script src="/assets/js/search.js"></script>

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

        <!-- SLIDER START -->
        <div class="slideshow swipeshow slidersize pointer" style="margin-top:0px;overflow:hidden">
            <ul class="slides">
                <li class="slide">
                    <img src="/assets/images/slider01.jpg" style="width:100%"/>
                </li>
                <li class="slide">
                    <img src="/assets/images/slider02.jpg" style="width:100%"/>
                </li>
                <li class="slide">
                    <img src="/assets/images/slider03.jpg" style="width:100%"/>
                </li>
            </ul>
            <div class='dots'></div>
        </div>
        <!-- // SLIDER -->

        <!-- INTRO -->
        <div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
             id="myeracademywelcome"></div>
             <?php   if(!isset($_GET["sec"]) && !isset($_GET["thd"])){?>

        <div style="font-family: 'aperculight';font-size:17px;line-height:24px;padding:40px 20px 0px 20px;max-width:768px;">
            <span style="font-family: 'MillerBanner-Roman';font-size:27px;font-weight: 410;line-height:1.25;text-transform:uppercase">
            Welcome to the Myer&nbsp;Academy</span>
            <div class="spacer20"></div>
            These learning moments have been crafted especially for your mobile device. Immerse yourself in the world we
            love and take your&nbsp;moment&nbsp;to&nbsp;shine.
            <div class="spacer50"></div>
        </div>
             <?php }
             if(isset($_GET["sec"]) || isset($_GET["thd"])){
                 $heading="";
                 $Content="";
                 $sql_content="";
                 if(isset($_GET["sec"])){
                    $heading=$_GET["sec"];
                    $sql_content="SELECT Content FROM subMainCategory WHERE smDescription= '".$heading."'";
                    
                } 
                if(isset($_GET["thd"])){
                    $heading=$_GET["thd"];
                    $sql_content="SELECT Content FROM thirdlevelgroup WHERE thlDescription = '". $heading."'";                    
                }
                if ($result_content = mysqli_query($link, $sql_content)) {
                    $rcount=mysqli_num_rows($result_content);
                    if($rcount){
                        /* fetch associative array */
                        while ($row = mysqli_fetch_row($result_content)) {
                           $Content= $row[0];
                        }
                    }
                        /* free result set */
                        mysqli_free_result($result_content);
                    }
                ?>
                
                  <div style="font-family: 'aperculight';font-size:17px;line-height:24px;padding:40px 20px 0px 20px;max-width:768px;">
            <span style="font-family: 'MillerBanner-Roman';font-size:27px;font-weight: 410;line-height:1.25;text-transform:uppercase">
                <?php echo $heading;?>            </span>
                <div class="spacer20"></div>
                <?php echo $Content;?>

                <div class="spacer50"></div>


            </div>
            
            <?php }
             ?>
        <!-- // INTRO -->
    
    
        <div align="center" style="padding:25px 8px;">
<!-- Search FORM START HERE ADDED  -->
        <form class="navbar-form" id="indexSearch" method="POST" name="indexSearch" style="margin:10px" >
                <div class="input-group add-on">
                  <input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. DENIM" name="adsrch-term" id="adsrch-term" type="text">
                  <div class="input-group-btn">
                    <button class="btn btn-default" id="AdSearch" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                <div class="input-group add-on">
                    
                <select class="form-control" id="searchFilter">
                        <option value='recent' >RECENT</option>
                        <option value='popular'>MOST POPULAR</option>
                        <option value='oldest'>OLDEST</option>
                      </select>
                      </div>
              </form>
  <!-- Search FORM END HERE ADDED  -->

<!-- SearchResultDiv will show search result dynamically start here added -->
<div class="SearchResultDiv" id="SearchResultDiv"></div>
<!-- SearchResultDiv will show search result dynamically End here added -->

<!-- FilterContent will show Filter result dynamically start here added -->
<div class="FilterContent" id="FilterContent"></div>
<!-- FilterContent will show Filter result dynamically start here added -->

<div class="pageContent">
              <?php if(!isset($_GET["sec"]) && !isset($_GET["thd"])){?>

            <div style="max-width:1600px;">
        <?php 
            $sql_query="SELECT  DISTINCT(pageId),PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory, ThirdLevelCategory,ImageName,(SELECT COUNT(Comment) FROM LMComment WHERE PageID = a.pageId) as noCooment, (SELECT COUNT(pageId) FROM AcadmeyUsertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LMPagelike WHERE PageID= a.pageId) as noPagelike FROM academyLM as a  GROUP By pageId ORDER BY  pageRanking ASC";
            $result = mysqli_query($link,$sql_query);
            // die if SQL statement failed
            if (!$result) {
            http_response_code(404);
            }
            else{
            
                   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                       ?>
                        <div class="main" id="main">
                            <a  href="<?php echo $row['articalFolder'];?>/index.html#/id/<?php echo $row['pageId'];?>" target="_self">
                             <img  src="/Portal/uploadedImages/<?php echo $row['ImageName'];?>"  class="lmimage" ></a>
                             <h2 class="subtitle"><?php echo $row['series']; ?></h2>
                            <a  href='<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' style='text-decoration: none' target="_self"> 
                             <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['PageTitle']; ?></u></h1>    </a>                                
                            <h2 class="headLine3"><?php echo $row['strapline']; ?></h2>
                                <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;"><?php echo $row['pageDescription']; ?></p>
                                    <div style="/*margin:0 auto;*/ border-bottom:1px dotted #e6e7e8;/*max-width:80%;*/">
                                        <div class="links-item-container" align="center">
                                            <i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews"><?php echo $row['noView'];?></span>
                                            <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes"><?php echo $row['noPagelike'];?></span>
                                            <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['noCooment'];?></span>
                                        </div>
                                        <br/>
                                        <a  href='<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>   
                                    </div>           
                        </div>

                   <?php
                   } 
               }
           ?>
            </div>
        
        <div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
             id="myeracademyabout"></div>
             <?php }
if(isset($_GET["sec"])|| isset($_GET["thd"])){

    //$sql_query="SELECT  pageId,PageTitle,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory, ThirdLevelCategory,ImageName, DisplayKeywords FROM academyLM ";
    $sql_query="SELECT  DISTINCT(pageId),PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory, ThirdLevelCategory,ImageName,(SELECT COUNT(Comment) FROM LMComment WHERE PageID = a.pageId) as noCooment, (SELECT COUNT(pageId) FROM AcadmeyUsertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LMPagelike WHERE PageID= a.pageId) as noPagelike FROM academyLM as a ";
    if($_GET['sec']){
    $Key= $_GET['sec'];
    $substring=" where SubCategory LIKE '%".mysqli_real_escape_string($link,$Key)."%' ORDER BY  pageRanking ASC";
    $sql_query.=$substring; 
}
  else  if( $_GET['thd']){
    $Key=$_GET['thd'];
    $substring=" where ThirdLevelCategory='".mysqli_real_escape_string($link,$Key)."'  ORDER BY  pageRanking ASC";
   $sql_query.=$substring; 
 }
 $result = mysqli_query($link,$sql_query);
 // die if SQL statement failed
 if (!$result) {
 http_response_code(404);
 }
 else{
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            
            ?>
                    <div class="main" id="main">
                        <a  href="<?php echo $row['articalFolder'];?>/index.html#/id/<?php echo $row['pageId'];?>" target="_self"> <img  src="/Portal/uploadedImages/<?php echo $row['ImageName'];?>"  class="lmimage" ></a>
                        <h2 class="subtitle"><?php echo $row['series']; ?></h2>
                        <a  href='<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' style='text-decoration: none' target="_self">  <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['PageTitle']; ?></u></h1>    </a>                                
                        <h2 class="headLine3"><?php echo $row['strapline']; ?></h2>
                            <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;"><?php echo $row['pageDescription']; ?></p>
                            <div style="/*margin:0 auto;*/ border-bottom:1px dotted #e6e7e8;/*max-width:80%;*/">
                                <div class="links-item-container" align="center">
                                    <i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews"><?php echo $row['noView'];?></span>
                                    <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes"><?php echo $row['noPagelike'];?></span>
                                    <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['noCooment'];?></span>
                                </div>
                                <br/>
                                <a  href='<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>   
                            </div>           
                    </div>



        <?php
        } 
    }
}
 ?>
        <div style="font-family: 'aperculight';font-size:17px;line-height:24px;padding:20px 30px;max-width:768px"
             align="center">
            <div class="hd-medium">
                TAKE YOUR MOMENT TO SHINE<br></div>
            The Myer Academy is a brand new world-class approach to learning. It provides you with a suite of learning
            tools and experiences to help grow and develop your career.<br/>
            <br/>
            This mobile platform is the heart of the Myer Academy. Wherever and whenever you choose to learn, access to
            our bite-sized learning moments will equip you with the right knowledge and know-how to confidently bring
            the love of shopping to life.<br/>
            <br/>
            Make every moment a moment to shine.
            <div class="spacer30"></div>
        </div>

        <div id="footer">
            &copy 2016 www.myeracademy.com.au<br><br>
            <img src="/assets/images/arrow_up.png" style="margin:20px 0px" class="pointer" onclick="scrolltotop()">
        </div>


    </div>
</div><!-- Pagecontent -->
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
        $('.logo-myeracademy2').css("opacity", "0");
        $('.menu').css("background", "rgba(0, 0, 0, 0)");
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
