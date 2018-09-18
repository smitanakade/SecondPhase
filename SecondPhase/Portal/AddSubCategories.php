<?php 

include_once("db_connect.php");
//include_once("check.php");
if(isset($_POST['Submit'])){
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
   $displayKeywordsTemp = str_replace(', ','>>',$_POST['DisplayKeywords']);
   $displayKeywordsDelimited = str_replace(',','>>',$displayKeywordsTemp);

 // taking respective Pagid form componentObject.json and inserting in to db
 $jsonString = "../content/".$_POST['articalFolder']."/course/en/contentObjects.json";
 $json = file_get_contents($jsonString);
 $array_json = json_decode($json, True);
  $pageId=$array_json[0]["_id"];  


   $sql = "INSERT INTO academyLM (pageId, PageTitle,strapline, articalFolder, pageDescription, keyword, MainCategory, SubCategory, ThirdLevelCategory, ImageName, DisplayKeywords,updatedon)
    VALUES('".mysqli_real_escape_string($link, $pageId)."','".mysqli_real_escape_string($link, $_POST['PageTitle'])."','".mysqli_real_escape_string($link, $strapline)."','".mysqli_real_escape_string($link, $_POST['articalFolder'])."','".mysqli_real_escape_string($link, $_POST['PageDescription'])."','".mysqli_real_escape_string($link, $_POST['Keyword'])."','".mysqli_real_escape_string($link, $_POST['MainCat'])."','".mysqli_real_escape_string($link, $_POST['SubCat'])."','".mysqli_real_escape_string($link, $_POST['thLid'])."' ,'".mysqli_real_escape_string($link, $_FILES['imageFile']['name'])."','".mysqli_real_escape_string($link, $displayKeywordsDelimited)."',NOW() )";
 
  if(mysqli_query($link, $sql)){
      $_SESSION['message']="Records inserted successfully.";
	  
	  
	  //upload image to local folder
	  $target_dir = "/Portal/uploadedImages/";
	  $file = $_FILES['imageFile']['name'];
	  $path = pathinfo($file);
	  $filename = $path['filename'];
	  $ext = $path['extension'];
	  $temp_name = $_FILES['imageFile']['tmp_name'];
	  $path_filename_ext = $target_dir.$filename.".".$ext;
	  
	  if (file_exists($path_filename_ext)) {
		 echo "Sorry, file already exists.";
	  }
	  else
	  {
		 move_uploaded_file($temp_name,$path_filename_ext);
		 echo "File Uploaded Successfully.";
	  }
	  
	  
	  //upload image to FTP server
	  /*
	  $ftp_server = "myftp.co.uk";
	  $ftp_user_name = "myusername";
	  $ftp_user_pass = "mypass";
	  $target_dir = "/public_html/my/directory/";
	  $source_file = $_FILES['imageFile']['tmp_name'];
      
	  // set up basic connection
	  $conn_id = ftp_connect($ftp_server);
	  ftp_pasv($conn_id, true); 
      
	  // login with username and password
	  $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
      
	  // check connection
	  if ((!$conn_id) || (!$login_result)) { 
	  	echo "FTP connection has failed!";
	  	echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
	  	exit; 
	  } else {
	  	echo "Connected to $ftp_server, for user $ftp_user_name";
	  }
	  
	  // upload the file
	  $upload = ftp_put($conn_id, $target_dir, $source_file, FTP_BINARY); 

	  // check upload status
	  if (!$upload) { 
		echo "FTP upload has failed!";
	  } 
	  else 
	  {
		echo "Uploaded $source_file to $ftp_server as $target_dir";
	  }

	  // close the FTP stream 
	  ftp_close($conn_id);
	  */
	  
	  
      header("Location:allPages.php");
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
	               		<h2 class="title">Myer Academy- Create & Assign Page</h1>
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
							<label for="name" class="cols-sm-2 control-label">Strapline</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="strapline" id="strapline"  placeholder="Strapline" required/>
								</div>
							</div>
                        </div>
                        
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Folder Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="articalFolder" id="articalFolder"  placeholder="Folder Name"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Description	</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="PageDescription" id="PageDescription"  placeholder="Page Description"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Keyword</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="Keyword" id="Keyword"  placeholder="Keyword" required/>
                                        
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
								<option value="">Select Main Group</option>
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["CategorieDescription"]."'>".$row["CategorieDescription"]."</option>";
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
								<option value="">Select Sub Group</option>

                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["smDescription"]."'>".$row["smDescription"]."</option>";
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
