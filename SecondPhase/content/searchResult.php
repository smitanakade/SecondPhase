<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!DOCTYPE html>
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

<script>
    $(document).ready(function () {
        $("#clearsearch").click(function () {
                    var full_url = document.URL;
                    $("#srch-term").val("");
                    event.preventDefault();
                    event.stopPropagation();
                    $("#indexSearch").submit();
                });
            });            
</script>

<style>
.loading {
    z-index: 10005;
}
.loading .loading-image {
    background-image: url('/assets/images/loader.gif');
}
</style>


<!--Boostrap Styles-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--FontAwesome-->
<!--[if IE 7]>
<link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->

<!--CSS Style-->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<?php //include_once("analyticstracking.php") ?>


</head>

<body onresize="resize(),slidersize()" onload="resize(),slidersize()">


<!-- dynamicMenu here adding menu dynamically -->
<div class="dynamicMenu">
</div>
    <!-- dynamicMenu here adding menu dynamically -->
<div align="center">
<div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
     id="myeracademywelcome"></div>
     <div id="ddddd" style="max-width:100%;min-height:70px;border-bottom:0.9px solid #ccc;"><img src="/Leader/assets/images/592fabe4ab4951b364eb10eb.jpeg" ></div>


<div>
<div class="beforeTopHeader">


<span   class="headLine">MYER ACADEMY SEARCH RESULT</span>
</div>
<form class="navbar-form" id="indexSearch" method="POST" name="indexSearch" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<div>
<div class="input-group add-on">
<input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. DENIM" name="srch-term" id="srch-term" type="text">
<div class="input-group-btn">
<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
</div>
</div>
</div>

<div>


              </div>
</form>


<div id="content">


<!-- SearchResultDiv will show search result dynamically start here added by SMITA RXP-->
<div class="SearchResultDiv" id="SearchResultDiv"></div>
<!-- SearchResultDiv will show search result dynamically End here added by SMITA RXP-->

<div align="center" style="padding:25px 8px;background:#FFF;">
    <div style="max-width:1600px;">
   
        
<!-- Here Comment, Rating, like and read comment Part starting -->
<?php 
include('db_connect.php');

$search = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST['srch-term'] : $_GET['sh']; 
if($search){
/* $query="SELECT pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory, 
ThirdLevelCategory,ImageName ,
(SELECT COUNT(Comment) FROM LMComment WHERE PageID = a.pageId) as noCooment,
 (SELECT COUNT(pageId) FROM AcadmeyUsertracking WHERE pageId= a.pageId ) as noView,
 (SELECT COUNT(pageLike) FROM LMPagelike WHERE PageID= a.pageId) as noPagelike FROM academyLM as a where
  PageTitle LIKE '%".$search."%' or keyword LIKE'%".$search."%' or pageDescription LIKE '%".$search."%' 
  or DisplayKeywords LIKE '%".$search."%' or MainCategory LIKE  '%".$search."%' 
 or SubCategory LIKE  '%".$search."%' or ThirdLevelCategory	LIKE  '%".$search."%'  GROUP BY pageId"; */
 $query="SELECT pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory, 
 ThirdLevelCategory,ImageName ,
 (SELECT COUNT(Comment) FROM LMComment WHERE PageID = a.pageId) as noCooment,
  (SELECT COUNT(pageId) FROM AcadmeyUsertracking WHERE pageId= a.pageId ) as noView,
  (SELECT COUNT(pageLike) FROM LMPagelike WHERE PageID= a.pageId) as noPagelike FROM academyLM as a where 
    match(PageTitle) against ('".$search."') or  
    match(keyword) against ('".$search."') 
    or  match(pageDescription) against ('".$search."') or 
    match(DisplayKeywords) against ('".$search."') 
    or match(MainCategory) against ('".$search."')
    or match(SubCategory) against ('".$search."') 
    or  match(ThirdLevelCategory) against ('".$search."') 	 GROUP BY pageId";
// echo $query;
$result = mysqli_query($link,$query);

// die if SQL statement failed
if (!$result) {
http_response_code(404);
}
else{
$rowcount=mysqli_num_rows($result);
if($rowcount){
    while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
   ?>
            <div class="main" id="main">
            <a  href="<?php echo $row['articalFolder'];?>/index.html#/id/<?php echo $row['pageId'];?>" target="_self"> <img  src="/Portal/uploadedImages/<?php echo $row['ImageName'];?>"  class="lmimage" ></a>
            <h2 class="subtitle"><?php echo $row['series']; ?></h2>
            <a  href='<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' style='text-decoration: none' target="_self">  <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['PageTitle']; ?></u></h1>    </a>                                
            <h2 class="subtitle"><?php echo $row['strapline']; ?></h2>
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
else{
    echo'<div >
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="font-size: 48px;color: #fbab92"></span>
    <br/><br/>
    <div id="SearchResultDiv">Oops! we couldn&#39;t find any results matching "'.$search.'"<br/>Try a new keyword or search the Myer Leaders Portal</div>
    <br/>
    <a href="#" class="button_cust"  target="_self" id="clearsearch">CLEAR SEARCH</a>
    </div>';
}
}

}
?>
    </div>
</div>

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
