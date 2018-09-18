<?php 
  // session_start();
  include_once("db_connect.php");
  
   if(isset($_POST['Submit'])){
    
//echo"sunadfa";
// taking respective Pagid form componentObject.json and inserting in to db
$jsonString = "../Leader/content/".$_POST['articalFolder']."/course/en/contentObjects.json";
$json = file_get_contents($jsonString);
$array_json = json_decode($json, True);
 $pageId=$array_json[0]["_id"];  

//fetching Subcategory baised on selected id 
$subMainCategory = "SELECT smDescription FROM subMainCategory WHERE smId=".$_POST['category']." limit 1";
$value= mysqli_fetch_assoc(mysqli_query($link, $subMainCategory));
$smDescription=$value['smDescription'];
//---- Removing apostroph in all the filed--//
$updatedRow="";
$pattern="/^'/";
$replacement="&#8217;";

$Title=(preg_match($pattern, $_POST['Title']) )? preg_replace($pattern, $replacement, $_POST['Title']): $_POST['Title'] ;
$series=(preg_match($pattern, $_POST['series']) )? preg_replace($pattern, $replacement, $_POST['series']): $_POST['series'] ;
$strapline=(preg_match($pattern, $_POST['strapline']) )? preg_replace($pattern, $replacement, $_POST['strapline']): $_POST['strapline'] ;
$articalFolder=(preg_match($pattern, $_POST['articalFolder']) )? preg_replace($pattern, $replacement, $_POST['articalFolder']): $_POST['articalFolder'] ;
$Description=(preg_match($pattern, $_POST['Description']) )? preg_replace($pattern, $replacement, $_POST['Description']): $_POST['Description'] ;
$Links=(preg_match($pattern, $_POST['Links']) )? preg_replace($pattern, $replacement, $_POST['Links']): $_POST['Links'] ;
$MainCategory=(preg_match($pattern, $_POST['MainCategory']) )? preg_replace($pattern, $replacement, $_POST['MainCategory']): $_POST['MainCategory'] ;
$category=(preg_match($pattern, $smDescription) )? preg_replace($pattern, $replacement, $smDescription): $smDescription ;
$CapabilityTag=(preg_match($pattern, $_POST['CapabilityTag']) )? preg_replace($pattern, $replacement, $_POST['CapabilityTag']): $_POST['CapabilityTag'] ;
$TopicSearchTags=(preg_match($pattern, $_POST['TopicSearchTags']) )? preg_replace($pattern, $replacement, $_POST['TopicSearchTags']): $_POST['TopicSearchTags'] ;
$Keyword=(preg_match($pattern, $_POST['Keyword']) )? preg_replace($pattern, $replacement, $_POST['Keyword']): $_POST['Keyword'] ;
$SecondaryLeadership=(preg_match($pattern, $_POST['SecondaryLeadership']) )? preg_replace($pattern, $replacement, $_POST['SecondaryLeadership']): $_POST['SecondaryLeadership'] ;
$pageRanking=(preg_match($pattern, $_POST['pageRanking']) )? preg_replace($pattern, $replacement, $_POST['pageRanking']): $_POST['pageRanking'] ;
$imageName=(preg_match($pattern, $_FILES["imageFile"]["name"]) )? preg_replace($pattern, $replacement, $_FILES["imageFile"]["name"]): $_FILES["imageFile"]["name"] ;

$sql = "INSERT INTO leaderlearningmoment (pageId, Title, series, strapline, articalFolder, Description, Links,MainCategory, category,CapabilityTag, TopicSearchTags, Keyword, SecondaryLeadership, pageRanking, imageName, updateOn)
    VALUES('".mysqli_real_escape_string($link, $pageId)."'
,'".mysqli_real_escape_string($link, $Title)."',
'".mysqli_real_escape_string($link, $series)."',
'".mysqli_real_escape_string($link, $strapline)."',
'".mysqli_real_escape_string($link, $articalFolder)."',
'".mysqli_real_escape_string($link, $Description)."',
'".mysqli_real_escape_string($link,$Links)."',
'".mysqli_real_escape_string($link, $MainCategory)."',
'".mysqli_real_escape_string($link, $category)."',
'".mysqli_real_escape_string($link, $CapabilityTag)."',
'".mysqli_real_escape_string($link, $TopicSearchTags)."',
'".mysqli_real_escape_string($link, $Keyword)."',
'".mysqli_real_escape_string($link, $SecondaryLeadership)."',
'".mysqli_real_escape_string($link, $pageRanking)."',
'".mysqli_real_escape_string($link, $imageName)."',NOW() )";
 
echo $sql;
 $result=mysqli_query($link, $sql);
 //print_r($result);
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
       //   header("Location:ViewPeopleLeaderLearningMoment.php");
          
   }
 //  header("Location:ViewPeopleLeaderLearningMoment.php");
   
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
	               		<h2 class="title">People Leader Portal - Create Learning Moment</h1>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;">	<?php	
if( isset($_SESSION['message']) )
{        echo $_SESSION['message'];
        unset($_SESSION['message']);

}
?></div>

	
                <div class="main-login main-center">
                <form action="" enctype="multipart/form-data" method="post"  name="LeadForm" id="LeadForm" autosubmit="off">
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Title" id="Title"  placeholder="Activity Title"/>
								</div>
							</div>
                        </div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Series</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="series" id="series" placeholder="series"/>
								</div>
							</div>
                        </div>
                       
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Strapline</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="strapline" id="strapline" placeholder="strapline"/>
								</div>
							</div>
                        </div>
					    <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description	</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Description" id="Description"   placeholder=" Description"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Folder Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="articalFolder" id="articalFolder"     placeholder="Folder Name"/>
								</div>
							</div>
                        </div>
                    <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Page Ranking</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="pageRanking" id="pageRanking"  placeholder="pageRanking"/>
                                  </div>
							</div>
                        </div>
                         <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Select Main Category</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <?php
                                $sql="SELECT Id,CategorieDescription FROM maincategories";
                                $result= mysqli_query($link, $sql) or die(mysql_error());
                                $count = mysqli_num_rows($result);
                                ?>
                            <select name="MainCategory" id="MainCategory">
                            <option value="">Select Main Group</option>

                              <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                               echo "<option value='".$row["CategorieDescription"]."'>".$row["CategorieDescription"]."</option>";
                              }?>
                         </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Sub Category</label>
							<div class="cols-sm-10">
								<div class="input-group">

					            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php
                                    $sql="SELECT smId,smDescription FROM subMainCategory";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="category" id="category">
								<option value="">Select Sub Group</option>

                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["smId"]."'>".$row["smDescription"]."</option>";
                                  }?>
                             </select>
								</div>
							</div>
                        </div>                      
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Link URL</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Links" id="Links"  placeholder="Link"/>
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Capability Tag</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="CapabilityTag" id="CapabilityTag"  placeholder="Capability Tag"/>
                                  </div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Topic Search Tags</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="TopicSearchTags" id="TopicSearchTags"  placeholder="TopicSearchTags"/>
                                  </div>
							</div>
                        </div> 
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Keyword</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="Keyword" id="Keyword"  placeholder="Keyword"/>
                                  </div>
							</div>
                        </div> 
                        <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Secondary Leadership Category</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" size="100" class="form-control" name="SecondaryLeadership" id="SecondaryLeadership"  placeholder="SecondaryLeadership"/>
                              </div>
                        </div>
                    </div>					
					
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Image Upload</label>
							<div class="cols-sm-10">
							
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="file" name="imageFile" id="fileSelect">
                                        
                                    </select>
								</div>
							</div>
                        </div>

                        <!-- <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Activity	</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="ActivityDuration" id="ActivityDuration"  placeholder="Activity Duration"/>
								</div>
							</div>
                        </div> -->
                       
                       
                   

								
                        <div class="form-group ">
                            <input type="submit" class="btn btn-primary btn-lg btn-block login-button" name="Submit" Id="Submit" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
    </form>
</body>
</html>