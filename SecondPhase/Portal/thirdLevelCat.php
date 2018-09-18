<?php 

include_once("db_connect.php");
//include_once("check.php");
if(isset($_POST['Submit'])){
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
   
   $sql = "INSERT INTO  thirdlevelgroup(thlDescription,Content,mainCatId,subCategorieId,visible) VALUES('".mysqli_real_escape_string($link, $_POST['Description'])."','".mysqli_real_escape_string($link, $_POST['Content'])."','".mysqli_real_escape_string($link, $_POST['MainCat'])."','".mysqli_real_escape_string($link, $_POST['SubCat'])."','".mysqli_real_escape_string($link, $_POST['visible'])."')";
  //echo  $sql;
   if(mysqli_query($link, $sql)){
      $_SESSION['Error']="Records inserted successfully.";
	  
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
	               		<h2 class="title">Myer Academy- Create & Assign Third Level Group</h1>
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
							<label for="name" class="cols-sm-2 control-label">Third Group Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Description" id="Description"  placeholder="Third Level Group Name" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Third Group Content</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>
                                    <textarea name="Content" class="form-control" id="Content" cols="30" rows="10" placeholder="Sub Group Content" required ></textarea>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Link With Main Category	</label>
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

                                   echo "<option value='".$row["Id"]."'>".$row["CategorieDescription"]."</option>";
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

                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
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
