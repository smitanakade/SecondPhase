<?php 

//include_once("check.php");

include_once("db_connect.php");
if(isset($_GET['delete'])){
//deleting record from the database
    $delete="DELETE FROM academyLM WHERE ID=".$_GET['delete'] ;
   mysqli_query($link, $delete) or die(mysql_error());
   header("Location:ViewAcademyLearningMoment.php");
}
if(isset($_POST['Submit'])){
  // Check connection
   if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  } 
// taking respective Pagid form componentObject.json and inserting in to db
$jsonString = "../content/".$_POST['articalFolder']."/course/en/contentObjects.json";
$json = file_get_contents($jsonString);
$array_json = json_decode($json, True);
 $pageId=$array_json[0]["_id"];  

//fetching Subcategory baised on selected id 
$subMainCategory = "SELECT smDescription FROM subMainCategory WHERE smId=".$_POST['SubCat']."";
$value= mysqli_fetch_assoc(mysqli_query($link, $subMainCategory));
$smDescription=$value['smDescription'];
$imageName=($_FILES['imageFile']['name']!="")?$_FILES['imageFile']['name']:$_POST['uploadedimage'];
$updatequery="UPDATE academyLM SET pageId='".mysqli_real_escape_string($link, $pageId)."',PageTitle='".mysqli_real_escape_string($link, $_POST['PageTitle'])."',series='".mysqli_real_escape_string($link, $_POST['series'])."',strapline='".mysqli_real_escape_string($link, $_POST['strapline'])."',articalFolder='".mysqli_real_escape_string($link, $_POST['articalFolder'])."',pageDescription='".mysqli_real_escape_string($link, $_POST['pageDescription'])."',keyword='".mysqli_real_escape_string($link, $_POST['keyword'])."',MainCategory='".mysqli_real_escape_string($link, $_POST['MainCat'])."',SubCategory='".mysqli_real_escape_string($link, $smDescription)."',ThirdLevelCategory='".mysqli_real_escape_string($link, $_POST['thLid'])."',pageRanking='".mysqli_real_escape_string($link, $_POST['pageRanking'])."',ImageName='".mysqli_real_escape_string($link, $imageName)."',DisplayKeywords='".mysqli_real_escape_string($link, $_POST['DisplayKeywords'])."',updatedon=NOW() Where Id='".$_POST['Id']."'";
//echo $updatequery;

 if(mysqli_query($link,$updatequery)){
    $_SESSION['Error']="Record updated Successfully!";
    if($_FILES["imageFile"]["name"]){
        //upload image to local folder
        $target_dir = "uploadedImages/";
        $target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
                $_SESSION['Error']+="<br/>The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
            } else {
                $_SESSION['Error']+="<br/>Sorry, there was an error uploading your file.";
            }
            
     }
     header("Location:ViewAcademyLearningMoment.php");
     
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
$pageid = $_GET['id'];
if($pageid){
 $sql= "SELECT Id, pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory,ThirdLevelCategory,pageRanking,ImageName,DisplayKeywords,updatedon FROM academyLM Where Id='".$pageid."'";
 
 $result= mysqli_query($link, $sql) or die(mysql_error());
 $count = mysqli_num_rows($result);
  while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
    extract($row);    
?>
                <div class="main-login main-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"  method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
               			<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="PageTitle" id="PageTitle" value="<?php echo strtoupper($PageTitle);?>" placeholder="Page Title"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Series</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="series" id="series" value="<?php echo strtoupper($series);?>" placeholder="series"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Strapline</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="strapline" id="strapline" value="<?php echo $strapline;?>" placeholder="Strapline"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pageDescription" id="pageDescription"  value='<?php echo $pageDescription;?>' placeholder="Page Description"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="PageId" id="PageId"  readonly  value='<?php echo $pageId;?>'  placeholder="Page Id"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">LM Folder Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="articalFolder" id="articalFolder"    value='<?php echo $articalFolder;?>'  placeholder="Folder Name"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Ranking</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="pageRanking" id="pageRanking" value='<?php echo $pageRanking;?>' placeholder="Page Ranking"/>
                                        
                                    </select>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Keywords</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="keyword"  value='<?php echo $keyword;?>' id="keyword"  placeholder="Keyword"/>
                                        
                                    </select>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Display Keywords</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="DisplayKeywords" id="DisplayKeywords" value='<?php echo $DisplayKeywords;?>' placeholder="Display Keywords"/>
                                        
                                    </select>
								</div>
							</div>
                        </div>       
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Main Group	</label>
							<div class="cols-sm-10">
								<div class="input-group">
					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT Id,CategorieDescription FROM maincategories";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="MainCat" id="MainCat">
                                <option value="">Select Main Group</option>
                                  <?php   while ($row1= mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected=($MainCategory==$row1["CategorieDescription"])? "Selected": "";
                                      
                                   echo "<option value='".$row1["CategorieDescription"]."' $selected>".$row1["CategorieDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Sub Group</label>
							<div class="cols-sm-10">
								<div class="input-group">
					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT smId,smDescription FROM subMainCategory";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="SubCat" id="SubCat">
                                <option value="">Select Sub Group</option>
                                  <?php   while ($row2 = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                    
                                       $selected2=($SubCategory==$row2["smDescription"])? "Selected": "";                                      
                                   echo "<option value='".$row2["smId"]."'  $selected2>".$row2["smDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
						</div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Third Level Group</label>
							<div class="cols-sm-10">
								<div class="input-group">
					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT thLid,	thlDescription FROM thirdlevelgroup";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="thLid" id="thLid">
                                <option value="">Select Third Level</option>

                                  <?php   while ($row3 = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected3=($ThirdLevelCategory==$row3["thlDescription"])? "Selected": "";                                      
                                       
                                   echo "<option value='".$row3["thlDescription"]."'  $selected3>".$row3["thlDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
                        </div>
                        <?php if($ImageName){?>
                        <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Uploaded Image Name</label>
                        <div class="cols-sm-10">
                        
                            <div class="input-group">
                                <?php echo $ImageName; ?>
                                <input type="hidden" name="uploadedimage" value="<?php echo $ImageName; ?>" >                                
                            </div>
                        </div>
                        </div>
                       <?php }?>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">IF You Want To ReUpload Image</label>
							<div class="cols-sm-10">
							
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="file" name="imageFile" id="fileSelect">
                                        
                                    </select>
								</div>
							</div>
                        </div>
                        
                        <div class="form-group ">
                        <input type="hidden" value="<?php echo $_GET['id'];?>" name="Id">
                            <input type="submit" class="btn btn-primary btn-lg " name="Submit" Id="Submit" value="Submit">
                            <a href="pageUpdate.php?delete=<?php echo $pageid;?>" class="btn btn-primary btn-lg" style="float: right;" onclick="return confirm('Are you sure you want to delete this item?');" name="Remove" Id="Remove" value="Remove">Remove</a>
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