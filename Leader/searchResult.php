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
<script src="/Leader/assets/js/LeaderFilter.js"></script>
<script src="/Leader/assets/js/LeaderCatActivity.js"></script>

<link href="/dynamic/css/styles_resp.css" rel="stylesheet" type="text/css" media="all" />

<?php include_once("db_connect.php");?>

</head>



<body onresize="resize(),slidersize()" onload="resize(),slidersize()">

     <!-- dynamicMenu here adding menu dynamically -->
     <div class="dynamicMenu">
        </div>
               

<div align="center">

<div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
id="myeracademywelcome"></div>
<div id="ddddd" style="max-width:100%;min-height:70px;"><img src="/Leader/assets/images/592fabe4ab4951b364eb10eb.jpeg" ></div>
<div style="font-family: 'aperculight';font-size:17px;line-height:24px;padding:8px 20px 0px 20px;">
        <div class="beforeTopHeader">
                <span   class="headLine">MYER LEADERS PORTAL</span>
            <h2  class="subtitle">OWN YOUR LEADERSHIP POTENTIAL</h2>
        </div>
            <form  id="indexSearch" method="POST" name="indexSearch" action="/Leader/searchResult.php" >
            
                                <div style="max-width:36%;">
                                    <div class="input-group add-on">
                                        <input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. CHANGE" name="srch-term" id="srch-term" type="text">
                                        <div class="input-group-btn">
                                                <button class="btn btn-default" id="homeSearchbtn" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
    
    </form>
    </div>

    <div >
   
    <div id="content">
     
   

<div align="center" style="padding:25px 8px;background:#FFF;">
            <div style="max-width:1600px;">
           
                
<!-- Here Comment, Rating, like and read comment Part starting -->
<?php 
include('db_connect.php');
$search = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['srch-term'] : $_GET['sh']; 
if($search!='')
{
   
   // $query="SELECT a.pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,(SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment, (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike  FROM leaderlearningmoment as a WHERE Title LIKE '%".$search."%' or strapline LIKE '%".$search."%' or Category LIKE'%".$search."%' or Filter LIKE '%".$search."%' or CapabilityTag LIKE '%".$search."%' or  SecondaryLeadership LIKE '%".$search."%' or Keyword LIKE '%".$search."%' or Description LIKE '%".$search."%' ORDER BY pageRanking";
    $query="SELECT a.pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,
    (SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment,
     (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,
    (SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike 
     FROM leaderlearningmoment as a WHERE
      match(Title) against ('".$search."') or
      match(strapline) against ('".$search."')  or
      match(Category) against ('".$search."') or 
     match(CapabilityTag) against ('".$search."')  or
      match(SecondaryLeadership) against ('".$search."')  or
      match(Keyword) against ('".$search."')  or
        match(MainCategory) against ('".$search."')  or
        match(series) against ('".$search."')  or
    
     match(Description) against ('".$search."') ORDER BY pageRanking";
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
        <a href="/Leader/content/<?php echo $row['articalFolder'] ; ?>/index.html#/id/<?php echo $row['pageId'] ; ?>" style="text-decoration: none; ;"> 
        <img  src="/Portal/uploadedImages/<?php echo  $row['imageName'];?>"  class="lmimage" ></a>
        <h2 class="subtitle"><?php echo $row['series']; ?></h2>
        <a href="/Leader/content/<?php echo $row['articalFolder'] ; ?>/index.html#/id/<?php echo $row['pageId'] ; ?>" style="text-decoration: none; ;"> 
        <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['Title'] ; ?></u></h1> </a>
        <h2 class="subtitle"><?php echo $row['strapline'] ; ?></h2>        
        <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;; "><?php echo $row['Description']; ?></p>
        <div style="border-bottom:1px dotted #e6e7e8;">
        <div class="links-item-container" align="center">
        <i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews"><?php echo  $row['noView']; ?></span> 
        <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes"><?php echo  $row['noPagelike'] ; ?></span>
        <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['noComment'] ; ?></span>
        </div><br/>        
        <a  href="/Leader/content/<?php echo $row['articalFolder'] ; ?>/index.html#/id/<?php echo  $row['pageId'] ; ?>" target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a> 
   </div>
           <?php
            }
        }/* else{
            echo'<div >
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="font-size: 48px;color: #fbab92"></span>
            <br/><br/>
            <div style=";">Oops! we couldn&#39;t find any results matching "'.$_POST['search'].'"</div>
            <br/>
            <a href="#" class="button_cust"  target="_self" id="clearsearch">CLEAR SEARCH </a>
            </div>';
        } */
      
    }


    //$activityQuery="SELECT Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName , (SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID = a.ID) as noComment,(SELECT COUNT(pageLike) FROM LeaderActivityPagelike WHERE ActivityID= a.ID) as noPagelike FROM leaderassociation as a  WHERE Title LIKE '%".$search."%' or series LIKE '%".$search."%' or strapline LIKE '%".$search."%' or Description LIKE '%".$search."%' or Links LIKE '%".$search."%' or ActivityDuration LIKE '%".$search."%' or Category LIKE '%".$search."%' or Filter LIKE '%".$search."%' or CapabilityTag LIKE '%".$search."%' or TopicSearchTags LIKE '%".$search."%' or Keyword LIKE '%".$search."%' or SecondaryLeadership LIKE '%".$search."%' or imageName LIKE '%".$search."%' and Filter NOT IN('Reflect - Learning Moment')  ORDER BY pageRanking";
    $activityQuery="SELECT Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName ,
    (SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID = a.ID) as noComment,(SELECT COUNT(pageLike) FROM LeaderActivityPagelike 
   WHERE ActivityID= a.ID) as noPagelike FROM leaderassociation 
   as a  WHERE 
   match(Title) against ('".$search."') or
    match(series ) against ('".$search."') or 
   match(strapline) against ('".$search."') or
    match(Description) against ('".$search."') or
   match(Links) against ('".$search."') or 
   match(Category) against ('".$search."') or
    match(Filter) against ('".$search."') or
    match(CapabilityTag) against ('".$search."') or
    match(TopicSearchTags) against ('".$search."') or
    match(Keyword) against ('".$search."') or
    match(SecondaryLeadership) against ('".$search."') or
    match(imageName) against ('".$search."')
    and Filter NOT IN('Reflect - Learning Moment')  ORDER BY pageRanking";
    $activityresult = mysqli_query($link,$activityQuery);
    //echo $activityQuery;
    // die if SQL statement failed
    if (!$activityresult) {
     http_response_code(404);
    }else{
    
      $ActRowCount = mysqli_num_rows($activityresult);
        if($ActRowCount >0){
    
          while($rowAct= mysqli_fetch_array($activityresult)){
            $pattern ='%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s';
            //if (preg_match($regex,  $row['Links'])) {}
              
              if(preg_match($pattern,  $rowAct['Links'])){
              $link=$rowAct['Links'];
              }else{
                  $link="/Portal/PDF/".$rowAct['Links'];
              }
            ?>
         <div class="main" id="main">
          <a href="<?php echo $link; ?>"  target="_blank"  style="text-decoration: none; ;"> 
          <img  src="/Leader/assets/images/<?php echo  $rowAct['imageName'];?>"  class="lmimage" ></a>
          <h2 class="subtitle"><?php echo $rowAct['series'];?></h2>
          <a href="<?php echo $link; ?>" target="_blank" style="text-decoration: none;"> 
          <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $rowAct['Title'];?></u></h1></a>
          <h2 class="subtitle"><?php echo $rowAct['strapline']; ?></h2>       
          <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;;"><?php echo $rowAct['Description']; ?></p>
          <div style="border-bottom:1px dotted #e6e7e8;">
          <div class="links-item-container" align="center">
          <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes"><?php echo $rowAct['noPagelike']; ?></span>
          <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $rowAct['noComment']; ?></span>
          </div><br/>       
          <a href="<?php echo $link; ?>" target="_blank" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>
            </div>
       <?php
          }
        }
    }

    if($rowcount<= 0 && $ActRowCount<=0){
        echo'<div >
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="font-size: 48px;color: #fbab92"></span>
        <br/><br/>
        <div id="SearchResultDiv">Oops! we couldn&#39;t find any results matching "'.$search.'"</div>
        <br/>
        <a href="#" class="button_cust"  target="_self" id="clearsearch">CLEAR SEARCH </a>
        </div>';
    }





    
}
else{
    echo'<div >
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="font-size: 48px;color: #fbab92"></span>
    <br/><br/>
    <div id="SearchResultDiv">Oops! we couldn&#39;t find any results matching "'.$search.'"</div>
    <br/>
    </div>';
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
