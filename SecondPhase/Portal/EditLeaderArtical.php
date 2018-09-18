<?php 
include_once("db_connect.php");
//include_once("check.php");

if(isset($_GET['delete'])){
	//deleting record from the database
		$delete="DELETE FROM leaderassociation WHERE ID=".$_GET['delete'] ;
	   mysqli_query($link, $delete) or die(mysql_error());
	   header("Location:ViewPeopleLeaderActivity.php");
	}
if(isset($_POST['Submit'])){
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
   $displayKeywordsTemp = str_replace(', ','>>',$_POST['DisplayKeywords']);
   $displayKeywordsDelimited = str_replace(',','>>',$displayKeywordsTemp);

   $Doc= ($_FILES["PDFFile"]["name"]!="")?$_FILES["PDFFile"]["name"]:$_POST['Links'];
   
 $sql="UPDATE  leaderassociation set 
 Title='".mysqli_real_escape_string($link,$_POST['Title'])."',
 series='".mysqli_real_escape_string($link,$_POST['series'])."',
 strapline='".mysqli_real_escape_string($link,$_POST['strapline'])."',
 Description='".mysqli_real_escape_string($link,$_POST['Description'])."',
 Links='".mysqli_real_escape_string($link,$Doc)."',
 pageRanking='".mysqli_real_escape_string($link,$_POST['pageRanking'])."',
 ActivityDuration='".mysqli_real_escape_string($link,$_POST['ActivityDuration'])."',
 MainCategory='".mysqli_real_escape_string($link,$_POST['MainCategory'])."',
 Category='".mysqli_real_escape_string($link,$_POST['Category'])."',
 Filter='".mysqli_real_escape_string($link,$_POST['Filter'])."',
 CapabilityTag='".mysqli_real_escape_string($link,$_POST['CapabilityTag'])."',
 TopicSearchTags='".mysqli_real_escape_string($link,$_POST['TopicSearchTags'])."',
 Keyword='".mysqli_real_escape_string($link,$_POST['Keyword'])."',
 SecondaryLeadership='".mysqli_real_escape_string($link,$_POST['SecondaryLeadership'])."',
 imageName='".mysqli_real_escape_string($link, $_POST['imageName'])."',
 updateOn=NOW() WHERE ID=".$_GET['id'];
	
 //echo $sql;
  if(mysqli_query($link, $sql)){
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
            //
            
     }
	  
	  
      header("Location:ViewPeopleLeaderActivity.php");
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


<?php //require_once("menu.php");?>


<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer People Leader- Update Activity Details</h1>
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
    $sql="SELECT ID,Title,series,strapline,Description,Links,pageRanking,ActivityDuration,MainCategory,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,imageName,updateOn FROM leaderassociation where ID=$pageid";
    $result= mysqli_query($link, $sql) or die(mysql_error());
 $count = mysqli_num_rows($result);
  while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
    extract($row);    
?>
<span style="font-size:bold;color:red;">NOTE*: FOR PEOPLE LEADER ACTIVITIES, THERE IS NO NEED TO UPLOAD IMAGE FILES.<br>
 JUST SELECT IMAGE NAME LIKE <strong>"READ.png, LISTEN.png, WATCH.png, DO.png"</strong> FOR THE ACTIVITY.<br><br> </span>	
                <div class="main-login main-center">
                <form action="" enctype="multipart/form-data" method="post"  name="LeadForm" id="LeadForm" autosubmit="off">
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label"> Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Title" id="Title" value="<?php echo $Title;?>" placeholder="Page Title"/>
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
                                    <input type="text" class="form-control" name="strapline" id="strapline" value="<?php echo strtoupper($strapline);?>" placeholder="Strapline"/>
								</div>
							</div>
                        </div>
                       
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                   <!-- <input type="text" class="form-control" name="Description" id="Description"  value='<?php echo $Description;?>' placeholder=" Description"/>
									-->
									<textarea rows="4" cols="50" placeholder="Description enter here" class="form-control" name="Description" id="Description" >
									<?php echo $Description;?>
									</textarea>
								</div>
							</div>
                        </div>
                       
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Link URL</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Links" id="Links"  value='<?php echo $Links;?>' placeholder="Link"/>
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
                                <input type="text" size="100" class="form-control" name="pageRanking" id="pageRanking" value="<?php echo $pageRanking;?>" placeholder="pageRanking"/>
                                  </div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Activity Duration</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="ActivityDuration" id="ActivityDuration" value="<?php echo $ActivityDuration;?>" placeholder="Activity Duration"/>
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
                                       $selected=($MainCategory==$row["CategorieDescription"])? "Selected": "";
                                       
							   echo "<option value='".$row["CategorieDescription"]."' ". $selected." >".$row["CategorieDescription"]."</option>";
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
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                         $selected=($Category==$row["smDescription"])? "Selected": "";                                                                             
                                       
                                   echo "<option value='".$row["smDescription"]."' ". $selected.">".$row["smDescription"]."</option>";
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
									   <option value="READ" <?php $selected=($Filter=="READ")?"selected":""; echo $selected;?>>READ</option>
									   <option value="LISTEN" <?php $selected=($Filter=="LISTEN")?"selected":""; echo $selected;?>>LISTEN</option>
									   <option value="WATCH" <?php $selected=($Filter=="WATCH")?"selected":""; echo $selected;?>>WATCH</option>
									   <option value="DO" <?php $selected=($Filter=="DO")?"selected":""; echo $selected;?>>DO</option>

										</select> 
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Capability Tag</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="CapabilityTag" id="CapabilityTag" value="<?php echo $CapabilityTag;?>" placeholder="Capability Tag"/>
                                  </div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Topic Search Tags</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="TopicSearchTags" id="TopicSearchTags" value="<?php echo $TopicSearchTags;?>" placeholder="TopicSearchTags"/>
                                  </div>
							</div>
                        </div> 
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Keyword</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="Keyword" id="Keyword" value="<?php echo $Keyword;?>"  placeholder="Keyword"/>
                                  </div>
							</div>
                        </div> 
                        <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Secondary Leadership Category</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" size="100" class="form-control" name="SecondaryLeadership" id="SecondaryLeadership" value="<?php echo $SecondaryLeadership;?>" placeholder="SecondaryLeadership"/>
                              </div>
                        </div>
                    </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Image</label>
							<div class="cols-sm-10">
							<select id="ImageName" name="imageName">
								<option value="READ.png" <?php $selected= ($imageName=="READ.png")?"selected":""; echo $selected;?>>READ.png</option>
								<option value="LISTEN.png" <?php $selected= ($imageName=="LISTEN.png")?"selected":"";echo $selected;?>>LISTEN.png</option>
								<option value="WATCH.png" <?php $selected= ($imageName=="WATCH.png")?"selected":"";echo $selected;?>>WATCH.png</option>
								<option value="DO.png" <?php $selected= ($imageName=="DO.png")?"selected":"";echo $selected;?>>DO.png</option>

							</select>
						</div>
							</div>
                        </div>
                        <div class="form-group ">
                            <input type="submit" class="btn btn-primary btn-lg " name="Submit" Id="Submit" value="Submit">
							<a href="EditLeaderArtical.php?delete=<?php echo $pageid;?>" class="btn btn-primary btn-lg" style="float: right;" onclick="return confirm('Are you sure you want to delete this item?');" name="Remove" Id="Remove" value="Remove">Remove</a>

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