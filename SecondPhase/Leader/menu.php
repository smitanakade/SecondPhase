
<?php
$html='<div id="myeracademywrap">
<div class="menustatus"></div>

<div id="mainmenu" align="left">
        
    
    <div class="scrollcontainer scrollheight2">
        <div class="scrollpanel">
            <div id="mainmenuinner">
                    <div class="menuHeader">        
                            
                                    <div class="beforeTopHeader">
                                            <ul class="nav navbar-nav">
                                                <li class="text-center">
                                                    <a href="/content/index.php"><i class="fa fa-lg  fa-home"></i><br><span style="text-decoration:underline;color: rgba(69, 69, 69, 0.4);">HOME</span></a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="mailto:myeracademy@myer.com.au"><i class="fa fa-lg fa-envelope-o"></i><br><span style="text-decoration:underline;color: rgba(69, 69, 69, 0.4);">GET IN TOUCH</span></a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="#" onclick="logout()"><i class="fa fa-lg fa-sign-out"></i><br><span style="text-decoration:underline;color: rgba(69, 69, 69, 0.4);">SIGN OUT</span></a>
                                                </li>
                                            </ul>
                                        
                                    </div>
                                    <div>
                                    <form  id="indexSearch" method="POST" name="indexSearch" action="/content/searchResult.php" >
                                    <div style="margin: 0px 23px;">
                                    <div class="input-group add-on">
                                          <input class="form-control" placeholder="SEARCH BY KEYWORD: E.G. CHANGE" name="srch-term" id="srch-term" type="text">
                                          <div class="input-group-btn">
                                            <button class="btn btn-default" id="SerchButton" type="submit" ><i class="fa fa-search"></i></button>
                                          </div>
                                        </div>
                                    </div>
                                      
                                        </form>
                                        </div>
                                </div>';
     


include_once("db_connect.php");
$sql = "SELECT Id as mainId,UPPER(CategorieDescription) as CategorieDescription From maincategories WHERE Id IN (SELECT mainCatId FROM subMainCategory)
ORDER BY Id ";
// excecute SQL statement
$result = mysqli_query($link,$sql);
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}else{
 // User array
 $sub_item=array();
$third_item=array();
while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  extract($row);
  $html.='<a href="/content/index.php" class="menu-container-main"><div class="btn-menu2">'.$CategorieDescription.'</div></a>';
       $sql_sub = "SELECT smId,UPPER(smDescription) AS subDescription,mainCatId FROM  subMainCategory WHERE  mainCatId=".$mainId;
      $result_sub= mysqli_query($link,$sql_sub);
      $count = mysqli_num_rows($result_sub); 
       if($count){
        while($sub_item= mysqli_fetch_array($result_sub, MYSQLI_ASSOC)){
            
           $third= "SELECT thLid, thlDescription FROM thirdlevelgroup WHERE mainCatId='".$sub_item['mainCatId']."' AND subCategorieId='".$sub_item['smId']."'";
          $thirdResult = mysqli_query($link,$third);
          $thcount = mysqli_num_rows($thirdResult);
          if($thcount){
           $html .= '<a href="/content/index.php?sec='.$sub_item["subDescription"].'" class="menu-container"><div class="btn-menu2">' . $sub_item["subDescription"] . '</div></a><div class="menu-child">';
            
            while($third_item= mysqli_fetch_array($thirdResult,MYSQLI_ASSOC)){
              $html .= '<a href="/content/index.php?thd='.$third_item["thlDescription"] .'" class="lnkmenu"><div class="btn-menu2' . ' btn-menu2-' . $third_item['thLid'] . '">' .$third_item["thlDescription"] . '</div></a>';
              
             } 
             $html.='</div>';
          }
           else if(!$thcount){ 
                    $path = ($sub_item['mainCatId']== 3)?"/Leader/Leader.php?pg":"/content/index.php?sec";
                  $html .= '<a  class="menu-item" href="'.$path.'='. $sub_item["subDescription"] .'" class="lnkmenu"><div class="btn-menu2">'. $sub_item["subDescription"] .'</div></a>';
               
          }
         
        
        }
   
      } 
     
  

  }
    
 $html.='      </div>
 </div>
</div>
<div style="width:100%;max-width:1200px;height:35px;margin-top:10px;display:block;background:rgba(156,156,156,0);cursor:pointer"
  align="center" onclick="openmenu()">
 <img src="/assets/images/arrow_up2.png" style="margin:5px 0px 0px 0px;cursor:pointer;width:55px">
</div>
</div>

<div align="center" onclick="openmenu()" id="menu">
 <a href="#" class="bar" ><i class="fa fa-bars fa-2x" aria-hidden="true" ></i></a>
 <img src="/assets/images/logo.png" class="logo-myeracademy2">
</div>
</div>';
  echo $html;
// close mysql connection
mysqli_close($link);
}
?>
