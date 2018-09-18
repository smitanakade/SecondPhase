   <?php 
   include_once("db_connect.php");
   session_start();
   if(isset($_POST['Submit'])){
	//fetching Subcategory baised on selected id 
$subMainCategory = "SELECT smDescription FROM subMainCategory WHERE smId=".$_POST['Category']." limit 1";
$value= mysqli_fetch_assoc(mysqli_query($link, $subMainCategory));
$smDescription=$value['smDescription'];
/* 

$Title=(preg_match($pattern, $_POST['Title']) )? preg_replace($pattern, $replacement, $_POST['Title']): $_POST['Title'] ;
$series=(preg_match($pattern, $_POST['series']) )? preg_replace($pattern, $replacement, $_POST['series']): $_POST['series'] ;
$strapline=(preg_match($pattern, $_POST['strapline']) )? preg_replace($pattern, $replacement, $_POST['strapline']): $_POST['strapline'] ;
$ActivityDuration=(preg_match($pattern, $_POST['ActivityDuration']) )? preg_replace($pattern, $replacement, $_POST['ActivityDuration']): $_POST['ActivityDuration'] ;
$Description=(preg_match($pattern, $_POST['Description']) )? preg_replace($pattern, $replacement, $_POST['Description']): $_POST['Description'] ;
$Links=(preg_match($pattern, $_POST['Links']) )? preg_replace($pattern, $replacement, $_POST['Links']): $_POST['Links'] ;
$MainCategory=(preg_match($pattern, $_POST['MainCategory']) )? preg_replace($pattern, $replacement, $_POST['MainCategory']): $_POST['MainCategory'] ;
$category=(preg_match($pattern, $smDescription) )? preg_replace($pattern, $replacement, $smDescription): $smDescription ;
$Filter=(preg_match($pattern, $_POST['Filter']) )? preg_replace($pattern, $replacement, $_POST['Filter']): $_POST['Filter'] ;
$CapabilityTag=(preg_match($pattern, $_POST['CapabilityTag']) )? preg_replace($pattern, $replacement, $_POST['CapabilityTag']): $_POST['CapabilityTag'] ;
$TopicSearchTags=(preg_match($pattern, $_POST['TopicSearchTags']) )? preg_replace($pattern, $replacement, $_POST['TopicSearchTags']): $_POST['TopicSearchTags'] ;
$Keyword=(preg_match($pattern, $_POST['Keyword']) )? preg_replace($pattern, $replacement, $_POST['Keyword']): $_POST['Keyword'] ;
$SecondaryLeadership=(preg_match($pattern, $_POST['SecondaryLeadership']) )? preg_replace($pattern, $replacement, $_POST['SecondaryLeadership']): $_POST['SecondaryLeadership'] ;
$pageRanking=(preg_match($pattern, $_POST['pageRanking']) )? preg_replace($pattern, $replacement, $_POST['pageRanking']): $_POST['pageRanking'] ;
$imageName=(preg_match($pattern, $_POST['imageName']) )? preg_replace($pattern, $replacement, $_POST['imageName']): $_FILES["imageFile"]["name"] ;

 */



    $Doc= ($_FILES["PDFFile"]["name"]!="")?$_FILES["PDFFile"]["name"]:$_POST['Links'];
    $insert="INSERT INTO leaderassociation (Title,series,strapline,Description,Links,ActivityDuration,MainCategory,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,pageRanking,imageName,updateOn) VALUES ('".mysqli_real_escape_string($link, $_POST['Title'])."','".mysqli_real_escape_string($link, $_POST['series'])."','".mysqli_real_escape_string($link, $_POST['strapline'])."','".mysqli_real_escape_string($link, $_POST['Description'])."','".mysqli_real_escape_string($link,$Doc)."','".mysqli_real_escape_string($link, $_POST['ActivityDuration'])."','".mysqli_real_escape_string($link,$_POST['MainCategory'])."','".mysqli_real_escape_string($link, $smDescription)."','".mysqli_real_escape_string($link, $_POST['Filter'])."','".mysqli_real_escape_string($link, $_POST['CapabilityTag'])."','".mysqli_real_escape_string($link, $_POST['TopicSearchTags'])."','".mysqli_real_escape_string($link, $_POST['Keyword'])."','".mysqli_real_escape_string($link, $_POST['SecondaryLeadership'])."','".mysqli_real_escape_string($link, $_POST['pageRanking'])."','".mysqli_real_escape_string($link, $_POST['imageName'])."',now())";
//echo $insert;

if(mysqli_query($link, $insert)){
	 $_SESSION['message']="Records Updated successfully.";
	 if($_FILES["PDFFile"]["name"]){
        //upload image to local folder
        $target_dir = "PDF/";
        $target_file = $target_dir . basename($_FILES["PDFFile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["PDFFile"]["tmp_name"], $target_file)) {
                $_SESSION['Error']+="<br/>The file ". basename( $_FILES["PDFFile"]["name"]). " has been uploaded.";
            } else {
                $_SESSION['Error']+="<br/>Sorry, there was an error uploading your file.";
            }
			header("ViewPeopleLeaderActivity.php");  
     }
}
else{
    $_SESSION['message']="Some thing went wrong Try again!.";
    
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
	               		<h2 class="title">Myer People Leader Portal - Add New Activity Details</h1>
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

<span style="font-size:bold;color:red;">NOTE*: FOR PEOPLE LEADER ACTIVITIES, THERE IS NO NEED TO UPLOAD IMAGE FILES.<br>
 JUST SELECT IMAGE NAME LIKE <strong>"READ.png, LISTEN.png, WATCH.png, DO.png"</strong> FOR THE ACTIVITY.<br><br> </span>	
                <div class="main-login main-center">
                <form action="" enctype="multipart/form-data" method="post"  name="LeadForm" id="LeadForm" autosubmit="off">
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label"> Title</label>
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
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Description" id="Description" placeholder=" Description"/>
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
							<label for="name" class="cols-sm-2 control-label">Upload PDF</label>
							<div class="cols-sm-10">
							
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="file" name="PDFFile" id="fileSelect">
                                        
                                    </select>
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
							<label for="name" class="cols-sm-2 control-label">Activity Duration</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="ActivityDuration" id="ActivityDuration"  placeholder="Activity Duration"/>
								</div>
							</div>
                        </div>
                     
                        <div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Select Main Group</label>
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
						<label for="name" class="cols-sm-2 control-label">Select Sub Group</label>
						<div class="cols-sm-10">
							<div class="input-group">

							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<?php
								$sql="SELECT smId,smDescription FROM subMainCategory";
								$result= mysqli_query($link, $sql) or die(mysql_error());
								$count = mysqli_num_rows($result);
								?>
							<select name="Category" id="Category">
							<option value="">Select Sub Group</option>

							  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

							   echo "<option value='".$row["smId"]."'>".$row["smDescription"]."</option>";
							  }?>
						 </select>
							</div>
						</div>
					</div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Activity Type</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                   <select name="Filter" id="Filter">
									   <option value="READ">READ</option>
									   <option value="LISTEN">LISTEN</option>
									   <option value="WATCH">WATCH</option>
									   <option value="DO">DO</option>

										</select> 
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
							<label for="name" class="cols-sm-2 control-label">Select Image</label>
							<div class="cols-sm-10">
							<select id="imageName" name="imageName">
								<option value="READ.png" >READ.png</option>
								<option value="LISTEN.png" >LISTEN.png</option>
								<option value="WATCH.png" >WATCH.png</option>
								<option value="DO.png" >DO.png</option>

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