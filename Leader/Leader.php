<?php if(!$_GET['pg']){
    header("Location: /Leader/index.php");
    }else{
       $ImageName = str_replace (' ', '', $_GET['pg']);        
    }
    include('db_connect.php');    
    ?>
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
               <!-- dynamicMenu here adding menu dynamically -->

<div align="center">
    <div id="content">

    
        <!-- INTRO -->
        <div style="margin:-60px 0px 60px 0px;display:block;width:100%;height:0px;position:relative;z-index:20;background:transparent"
             id="myeracademywelcome"></div>
             <div id="ddddd" style="max-width:100%;min-height:70px;"><img src="/Leader/assets/images/592fabe4ab4951b364eb10eb.jpeg" ></div>

        <div style="font-family: 'aperculight';font-size:17px;line-height:24px;padding:8px 10px 0px 10px;">
            <div class="beforeTopHeader">
                    <span   class="headLine">MYER LEADERS PORTAL</span>
                <h2  class="subtitle">OWN YOUR LEADERSHIP POTENTIAL</h2>
            </div>
            <!--This Page body search option code -->
            <form  id="indexSearch" method="POST" name="indexSearch" action="/Leader/searchResult.php" >

                    <div style="max-width:36%;">
                        <div class="input-group add-on">
                            <input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. CHANGE" name="homeSearch" id="homeSearch" type="text">
                            <div class="input-group-btn">
                                    <button class="btn btn-default" id="homeSearchbtn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="spacer20"></div>
<!-- HeroImage START genrating Hero image baised on mensu selection-->
<div style="max-width:1600px;">

                <div class="mainHead" id="mainHead">
                <img src="/Leader/assets/images/<?php echo "CAT_".$ImageName;?>.jpg" class="LeaderHeroImg">
              
                </div>
                                </div>
                    <div class="LeaderHearoContent">
                                <div class="spacer20"></div>
                                <!-- Here Fetching content for particular category baised on menu selection  START-->
                                <?php
                                $sql_content="SELECT Content FROM subMainCategory WHERE smDescription LIKE '%".$_GET['pg']."%'";
                                if ($result_content = mysqli_query($link, $sql_content)) {
                                    $rcount=mysqli_num_rows($result_content);
                                    if($rcount){
                                        /* fetch associative array */
                                        while ($row = mysqli_fetch_row($result_content)) {
                                            echo  $row[0];
                                        }
                                    }
                                        /* free result set */
                                        mysqli_free_result($result_content);
                                    }
                                ?>
                                <!-- Here Fetching content for particular category baised on menu selection   END-->


                    </div>
           
                <div align="center" style="padding:25px 8px;">
            <!-- SearchResultDiv will show search result dynamically start here added -->
            <div class="SearchResultDiv" id="SearchResultDiv"></div>
            <!-- SearchResultDiv will show search result dynamically End here added -->
            </div>

                <select id="filter" class="form-control">
                        <option value=''>FILTER BY</option>
                        <option value='watch' >WATCH</option>
                        <option value='LISTEN'>LISTEN</option>
                        <option value='READ'>READ</option>
                        <option value='DO'>DO</option>
                        <option value='REFLECT'>REFLECT</option>  
                </select>                  
            </form>

        </div>
        <!-- // INTRO -->
    
    
        <div align="center" style="padding:25px 8px;">
            <!-- SearchResultDiv will show search result dynamically start here added -->
<!--             <div class="SearchResultDiv" id="SearchResultDiv"></div>
 -->            <!-- SearchResultDiv will show search result dynamically End here added -->
            <div style="max-width:1600px;">
            <div id="filterResult"></div>
                <!-- page start -->
                <div id="Page">
                <?php 
                if(isset($_GET['pg']) && !isset($_GET['fl'])){
                    $Key=$_GET['pg'];
                    $query= "SELECT pageId,Title,series,strapline,articalFolder,Description,Category,CapabilityTag,Keyword,SecondaryLeadership,imageName ,(SELECT COUNT(Comment) FROM LeaderLMComment WHERE PageID = a.pageId) as noComment, (SELECT COUNT(pageId) FROM usertracking WHERE pageId= a.pageId ) as noView,(SELECT COUNT(pageLike) FROM LeaderLMPagelike WHERE PageID= a.pageId) as noPagelike  FROM leaderlearningmoment as a WHERE Category Like '%$Key%' ORDER BY pageRanking";
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
                                <a  href='/Leader/content/<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' target="_self"> <img  src="/Portal/uploadedImages/<?php echo $row['imageName'];?>"  class="lmimage" ></a>
                                <h2 class="subtitle"><?php echo $row['series']; ?></h2>
                                <a  href='/Leader/content/<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' style='text-decoration: none' target="_self">  <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['Title']; ?></u></h1>    </a>                                
                                <h2 class="subtitle"><?php echo $row['strapline']; ?></h2>
                                    <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;"><?php echo $row['Description']; ?></p>
                                    <div style="/*margin:0 auto;*/ border-bottom:1px dotted #e6e7e8;/*max-width:80%;*/">
                                        <div class="links-item-container" align="center">
                                      
                                        <i class="fa fa-fw fa-eye faView"></i><span class="faViewText" id="noViews"><?php echo $row['noView'];?></span>
                                       
                                        <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes"><?php echo $row['noPagelike'];?></span>
                                        
                                        <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['noComment'];?></span>
                                        </div>
                                        <br/>
                                        <a  href='/Leader/content/<?php echo $row['articalFolder']."/index.html#/id/". $row['pageId'];?>' target="_self" class="button_cust" style="margin-bottom:20px;"> CONTINUE READING </a>   

                <!--                         <div class="keyword"><span>keyword1</span>|<span>keyword1</span>|<span>keyword1</span>|<span>keyword1</span>|<span>keyword1</span></div>
                            --> </div>           
                                </div>
                        <?php
                            }
                        }
                        else{
                           // echo"NO Record Found!!";
                        }
                    }
                $query_fl="SELECT DISTINCT ID,Title,series,strapline,Description,Links,Category,Filter,CapabilityTag,Keyword,SecondaryLeadership,
                imageName , 
                (SELECT GROUP_CONCAT(UserId) FROM LeaderActivityPagelike WHERE ActivityID=leaderassociation.ID) AS CmtLikedId,        
                (SELECT COUNT(pageLike) from LeaderActivityPagelike where ActivityID=leaderassociation.ID ) as likepg,
                 (SELECT COUNT(Comment) FROM LeaderActivityComment WHERE ActivityID=leaderassociation.ID )as comment FROM leaderassociation 
                 WHERE Category Like '%$Key%' and Filter IN('Do','Listen','Read','Watch') ORDER BY Filter"; 
                $result_fl = mysqli_query($link,$query_fl);
               // echo  $query_fl;
             
                     // die if SQL statement failed
                     if (!$result_fl) {
                     http_response_code(404);
                     }
                     else{
                        $pattern2="/,/";                        
                         $rowcount=mysqli_num_rows($result_fl);
                         if($rowcount){
                             while ($row = mysqli_fetch_array($result_fl, MYSQL_BOTH)) {
                                $disabled="";
                                $content="LIKE";
                                $class="fa fa-heart fa-fw faAction";
                              if($row['CmtLikedId']){
                                    if(preg_match ($pattern2 , $row['CmtLikedId'])){
                                            $lookup = preg_split($pattern2, $row['CmtLikedId']);
                                        for($i=0;$i<= count($lookup); $i++){
                                            if ($lookup[$i] == $UserId) {
                                                $disabled='style=" pointer-events: none;"';
                                                $content="LIKED";
                                                $class="fa fa-fw fa-heart faView";
                                                
                                                break;
                                            }else{
                                                $disabled="";
                                            }
                                    }
                                }else{
                                    if ($row['CmtLikedId'] == $UserId) {
                                        $disabled='style=" pointer-events: none;"';
                                        $content="LIKED";
                                        $class="fa fa-fw fa-heart faView";
                                        
                                    }else{
                                        $disabled="";
                                    }
                                }
                        }
                              
                               
                                 //  $pos = strpos($row['Links'], "//");
                              $pattern ='%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s';
                               //if (preg_match($regex,  $row['Links'])) {}
                                 
                                 if(preg_match($pattern,  $row['Links'])){
                                 $link=$row['Links'];
                                 }else{
                                     $link="/Portal/PDF/".$row['Links'];
                                 }  ?>
                                 <div class="main" id="main<?php echo $row['ID'];?>">
                                 <a href='<?php echo $link;?>' target="_blank" > <img  src="/Leader/assets/images/<?php echo $row['imageName'];?>" style="max-width:100%" >  </a>  
                                     <h2 class="subtitle"><?php echo $row['series']; ?></h2>
                                     <a href='<?php echo $link;?>' target="_blank" style="text-decoration: none;" >    <h1 class="headLine2"><u style=" text-decoration: none;border-bottom: 1px solid #939393;"><?php echo $row['Title']; ?></u></h1>   </a>                                 
                                     <h2 class="subtitle"><?php echo $row['strapline']; ?></h2>
                                     <p style="text-align:center;padding:5px;max-width:800px;font-family:ApercuLight;"><?php echo $row['Description']; ?></p>
                                     <div style="/*margin:0 auto;*/ border-bottom:1px dotted #e6e7e8;/*max-width:80%;*/">
                                     <div class="links-widget component-widget">
                                                         <div class="links-item component-item clearfix top">
                                                             <div class="links-item-container" id="pgActivity" align="center">
                                                            
                                                                 <i class="fa fa-fw fa-heart faView"></i><span class="faViewText" id="noLikes<?php echo $row['ID'];?>"><?php echo $row['likepg'];?></span>
                                                                 
                                                                 <i class="fa fa-fw fa-comment faView"></i><span class="faViewText" id="noComments"><?php echo $row['comment'];?></span>
                                                                 
                                                             </div>                                                            
                                     
                                     <div class="links-item-container" align="center">                                                                      
                                         <a href="#" class="links-item-link like-buttons" id="LIKE-<?php echo $row["ID"];?>">
                                         <!-- <i class="fa fa-heart fa-fw faAction"></i><span class="faActionText">LIKE&nbsp;&nbsp;&nbsp;&nbsp;</span>  -->
                                         <i class='<?php echo $class;?>'></i><span class="faActionText"><?php echo  $content;?>&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                                        </a>
                                         <span class="separator"></span>
                                         <a href="#" class="links-item-link like-comment" id="<?php echo $row["ID"];?>">
                                         <i class="fa fa-comment fa-fw faAction"></i><span class="faActionText">COMMENT</span> 
                                         </a> 
                                     </div>
                                     <div id="divAddComment<?php echo $row["ID"];?>" class="divAddComment" >
                                     <!-- coment -->    
                                     <div class="links-body component-body">
                                     <div class="links-body-inner component-body-inner">
                                     </div>
                                 </div>
 
                                 <div>
                                     <textarea id="comment<?php  echo $row["ID"];?>" class="leadercomment" name="comment" placeholder="Enter comment here..."></textarea>
                                 </div>
 
                                 <div class="buttons-cluster-bottom clearfix" align="center">
                                     <div class="buttons-marking-icon icon display-none">
                                     </div>                                     
                                     <a href="#" class="Postcomment" id="<?php  echo $row["ID"];?>">POST COMMENT</a> 
                                 </div>
                                         <!--Coment -->  
                                         <div class="buttons-cluster-bottom clearfix" align="center">
                                           <div class="buttons-marking-icon icon display-none">
                                             </div>
                                         </div>
                                          <div class="comments-container" id="listComments<?php  echo $row['ID'];?>">
                                          </div>                             
                                      </div>
                                     <br/>
                                  </div>           
                             </div>
                             </div>
                             </div>
                         <?php
                             }
                         }
                         
                 }
                
                
                }


                ?>
                </div>
                <!-- page end-->
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
