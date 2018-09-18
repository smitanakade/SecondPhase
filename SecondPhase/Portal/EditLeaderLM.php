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
	               		<h2 class="title">People Leader Portal - Update Learning Moment Details</h1>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;">		
</div>
<?php
$pageid = $_GET['id'];
if($pageid){
 $sql= "SELECT pageId, Title, series, strapline, articalFolder, Description, Links,MainCategory, category, CapabilityTag, TopicSearchTags, Keyword, SecondaryLeadership, pageRanking, imageName, updateOn FROM leaderlearningmoment Where ID='".$pageid."'";
 $result= mysqli_query($link, $sql) or die(mysql_error());
 $count = mysqli_num_rows($result);
 $updatedRow="";
 $pattern="/^'/";
 $replacement="&#8217;";
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
                                    <input type="text" class="form-control" name="Title" id="Title" value="<?php echo strtoupper($Title);?>" placeholder="Page Title"/>
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
							<label for="name" class="cols-sm-2 control-label">Page Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Description" id="Description"  value='<?php  $data= (preg_match($pattern, mysqli_real_escape_string($link,$Description)) )? preg_replace($pattern, $replacement, mysqli_real_escape_string($link,$Description)): mysqli_real_escape_string($link,$Description) ; echo $data;?>' placeholder="Page Description"/>
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
							<label for="name" class="cols-sm-2 control-label">Folder Name</label>
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
							<label for="name" class="cols-sm-2 control-label">Select Main Category	</label>
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
                                  <?php   while ($row1= mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected=($MainCategory==$row1["CategorieDescription"])? "Selected": "";
                                      
                                   echo "<option value='".$row1["CategorieDescription"]."' $selected>".$row1["CategorieDescription"]."</option>";
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
                                  <?php   while ($row2 = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected2=($category==$row2["smDescription"])? "Selected": "";                                      
                                   echo "<option value='".$row2["smId"]."'  $selected2>".$row2["smDescription"]."</option>";
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
                                    <input type="text" class="form-control" name="Links" id="Links"  value='<?php echo $Links;?>' placeholder="Links or PDF Name"/>
								</div>
							</div>
                        </div>
                        
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Capability Tag</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="CapabilityTag" id="CapabilityTag"  value='<?php echo $CapabilityTag;?>' placeholder="Capability Tag"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Topic Search Tags</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="TopicSearchTags" id="TopicSearchTags"  value='<?php echo $TopicSearchTags;?>' placeholder="Topic Search Tags"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Keyword</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="Keyword"  value='<?php echo $Keyword;?>' id="Keyword"  placeholder="Keyword"/>
                                        
                                    </select>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Secondary Leadership Category</label>
							<div class="cols-sm-10">
								<div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" size="100" class="form-control" name="SecondaryLeadership" id="SecondaryLeadership" value='<?php echo $SecondaryLeadership;?>' placeholder="Secondary Leadership"/>
                                        
                                    </select>
								</div>
							</div>
                        </div>           

                        <?php if($imageName){?>
                            <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Image Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?php echo $imageName;?>
                                    <input type="hidden" name="uploadedimage" value="<?php echo $imageName;?>" >                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                       <?php }?>
                        <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">IF You Want To Re-Upload Image</label>
                        <div class="cols-sm-10">
                        
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="file" name="imageFile" id="imageFile" accept="image/*"/>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="form-group ">
                        <input type="hidden" value="<?php echo $_GET['id'];?>" name="Id">
                            <input type="submit" class="btn btn-primary btn-lg " name="Submit" Id="Submit" value="Submit">
                            <a href="EditLeaderLM.php?delete=<?php echo $pageid;?>" class="btn btn-primary btn-lg" style="float: right;" onclick="return confirm('Are you sure you want to delete this item?');" name="Remove" Id="Remove" value="Remove">Remove</a>
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