
<?php 

//include_once("check.php");

include_once("db_connect.php");
if(isset($_POST['Submit'])){
  // Check connection
   if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  } 
// Attempt insert query execution
   $sql = "UPDATE subcategories set PageTitle='".mysql_real_escape_string($_POST['PageTitle'])."',pageDescription='".mysql_real_escape_string($_POST['PageDescription'])."',keyword='".mysql_real_escape_string($_POST['Keyword'])."',MainCatId ='".mysql_real_escape_string($_POST['MainCat'])."', smId= '".mysql_real_escape_string($_POST['SubCat'])."' , thLid='".mysql_real_escape_string($_POST['PageTitle'])."' WHERE PageId='".mysql_real_escape_string($_POST['PageId'])."'";
   
   if(mysqli_query($link, $sql)){
      $_SESSION['message']="Records updated successfully.";
      header('Location:ViewAcademyLearningMoment.php');
  } else{
	  $_SESSION['Error'] = "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	   
     // Close connection
  mysqli_close($link);
} 
}
    ?>
<html>
<head>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />

<script src="./js/jquery-1.12.4.min.js" type="application/javascript"></script>

<script src="./js/bootstrap.min.js" type="application/javascript"></script>
<link rel='stylesheet' type='text/css' href='./css/bootstrap.min.css'>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    
	<!--FontAwesome-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
	
	<!--CSS Style-->
    <link href="./css/ace-responsive-menu.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./css/registerUserCss.css" rel="stylesheet" type="text/css" />
</script>

</head>


<?php require_once("menu.php");?>

	
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy- Update Page Detail</h1>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;">	<?php	
if( isset($_SESSION['Error']) )
{        echo $_SESSION['Error'];
        unset($_SESSION['Error']);

}
?></div>
<?php
$thLid = $_GET['id'];
if($thLid){
 $sql= " SELECT thLid,thlDescription, m.CategorieDescription as mainCat,m.Id as mainId, s.smId as subId ,s.smDescription as subCat FROM thirdlevelgroup as th LEFT JOIN maincategories as m on th.mainCatId= m.Id LEFT JOIN submaincategory as s on th.subCategorieId = s.smId Where th.thLid='".$thLid."'";
 $result= mysqli_query($link, $sql) or die(mysql_error());
 $count = mysqli_num_rows($result);
  while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
    extract($row);
    
?>
                <div class="main-login main-center">
                <form action="" method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="thlDescription" id="thlDescription" value="<?php echo strtoupper($thlDescription);?>" placeholder="Page Title"/>
								</div>
							</div>
                        </div>
                   
                        
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Link With Main Categorie	</label>
							<div class="cols-sm-10">
								<div class="input-group">
					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT Id,CategorieDescription FROM maincategories";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="MainCat" id="MainCat">
                                  <?php   while ($row1= mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected=($mainId==$row1["Id"])? "Selected": "";
                                      
                                   echo "<option value='".$row1["Id"]."' $selected>".$row1["CategorieDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Link With Sub Main Group	</label>
							<div class="cols-sm-10">
								<div class="input-group">
					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT smId,smDescription FROM subMainCategory";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="SubCat" id="subCat">
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected=($subId==$row["smId"])? "Selected": "";
                                       
                                   echo "<option value='".$row["smId"]."'>".$row["smDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
						</div>
                       
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Visible</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                    <select id="visible" name="visible">
                                    <option value="" >SELECT</option>

                                    <option value="YES" <?php if($visible =='YES') echo "Selected"; else echo "";?>>YES</option>
                                    <option value="NO"   <?php if($visible =='NO') echo "Selected"; else echo "";?>>NO</option>
                                    </select>
								</div>
							</div>
                        </div>
                       
                      
                        <div class="form-group ">
                            <input type="submit" class="btn btn-primary btn-lg btn-block login-button" name="Submit" Id="Submit" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
    
</body>
</html>
             <?php }}
             else{
$_SESSION['Error']= 'Please Check Again PageId is not correct!!';     
                                }                           
                                ?>