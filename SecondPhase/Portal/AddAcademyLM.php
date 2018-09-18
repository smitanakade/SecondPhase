<?php 

include_once("db_connect.php");
//include_once("check.php");
if(isset($_POST['Submit'])){
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  /*  $displayKeywordsTemp = str_replace(', ','>>',$_POST['DisplayKeywords']);
   $displayKeywordsDelimited = str_replace(',','>>',$displayKeywordsTemp);
 */
 // taking respective Pagid form componentObject.json and inserting in to db
 $jsonString = "../content/".$_POST['articalFolder']."/course/en/contentObjects.json";
 $json = file_get_contents($jsonString);
 $array_json = json_decode($json, True);
  $pageId=$array_json[0]["_id"];  

//fetching Subcategory baised on selected id 
$subMainCategory = "SELECT smDescription FROM subMainCategory WHERE smId=".$_POST['SubCat']." limit 1";
$value= mysqli_fetch_assoc(mysqli_query($link, $subMainCategory));
$smDescription=$value['smDescription'];

   $sql = "INSERT INTO academyLM (pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory,ThirdLevelCategory,pageRanking,ImageName,DisplayKeywords,updatedon)
  VALUES('".mysqli_real_escape_string($link, $pageId)."','".mysqli_real_escape_string($link, $_POST['PageTitle'])."','".mysqli_real_escape_string($link,$_POST['series'])."','".mysqli_real_escape_string($link, $_POST['strapline'])."','".mysqli_real_escape_string($link, $_POST['articalFolder'])."','".mysqli_real_escape_string($link, $_POST['pageDescription'])."','".mysqli_real_escape_string($link, $_POST['keyword'])."','".mysqli_real_escape_string($link, $_POST['MainCat'])."','".mysqli_real_escape_string($link, $smDescription)."','".mysqli_real_escape_string($link, $_POST['thLid'])."','".mysqli_real_escape_string($link,$_POST['pageRanking'])."' ,'".mysqli_real_escape_string($link, $_FILES['imageFile']['name'])."','".mysqli_real_escape_string($link, $_POST['DisplayKeywords'])."',NOW() )";
			//echo $sql;	   
			$result =mysqli_query($link, $sql);
  if($result){  
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
            header("Location:ViewAcademyLearningMoment.php");
            
     }
	  
      header("Location:ViewAcademyLearningMoment.php");
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
	               		<h2 class="title">Myer Academy- Create Learning Moment</h1>
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
                <div class="main-login main-center">
                <form action="" enctype="multipart/form-data" method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="PageTitle" id="PageTitle"  placeholder="Page Title" required/>
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Series</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="series" id="series"  placeholder="Series" />
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Strapline</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="strapline" id="strapline"  placeholder="Strapline" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pageDescription" id="pageDescription"  placeholder="Page Description"/>
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">LM Folder Name </label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="articalFolder" id="articalFolder"  placeholder="LM Folder" required/>
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Ranking</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pageRanking" id="pageRanking"  placeholder="Page Ranking" required/>
									</div>
							</div>
                        </div>						
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Keywords</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="keyword" id="keyword"  placeholder="keyword" required/>
                                        
                                    </select>
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Display Keywords</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="DisplayKeywords" id="DisplayKeywords"  placeholder="Display Keywords"/>
                                        
                                    </select>
								</div>
							</div>
                        </div>						
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label"> Select Main Group</label>
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
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["CategorieDescription"]."'>".$row["CategorieDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Sub Group	</label>
							<div class="cols-sm-10">
								<div class="input-group">

					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT smId,smDescription FROM subMainCategory";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="SubCat" id="subCat">
								<option value="">Select Sub Group</option>

                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["smId"]."'>".$row["smDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label"> Select Third Level Group	</label>
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
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["thlDescription"]."'>".$row["thlDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
                        </div>						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Upload Image</label>
							<div class="cols-sm-10">
							
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="file" name="imageFile" id="imageFile" accept="image/*"/>
                                        
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
