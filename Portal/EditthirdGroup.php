<?php
include_once("db_connect.php");
if(isset($_GET['delete'])){
    //deleting record from the database
        $delete="DELETE FROM thirdlevelgroup WHERE thLid=".$_GET['delete'] ;
        //echo $delete;
       mysqli_query($link, $delete) or die(mysql_error());
       header("Location:ViewThirdGroup.php"); 
    }

    if(isset($_POST['Submit'])){

       $query="update thirdlevelgroup set thlDescription='".mysqli_real_escape_string($link, $_POST['thlDescription'])."',Content='".mysqli_real_escape_string($link, $_POST['Content'])."',mainCatId='".mysqli_real_escape_string($link,$_POST['MainCat'])."',subCategorieId='".mysqli_real_escape_string($link,$_POST['subCat'])."',visible='".mysqli_real_escape_string($link, $_POST['visible'])."'  where thLid=".$_POST['Id'] ;
        mysqli_query($link,$query);
        header("Location:ViewThirdGroup.php");
        
        }        
?>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="./js/jquery-1.12.4.min.js" type="application/javascript"></script>
    <script src="./js/bootstrap.min.js" type="application/javascript"></script>
    <link rel='stylesheet' type='text/css' href='./css/bootstrap.min.css'>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

	<script src="./js/articleReport.js" type="application/javascript"></script>
    <!--CSS Style-->
    <link href="./css/ace-responsive-menu.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./css/registerUserCss.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php require_once("menu.php");?>
    <br />
    <div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy and People Leader Menu Sub Group</h2>
	               		<hr />
	               	</div>
                </div> 
            <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"  method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">

            <?php 
$pageid = $_GET['id'];
if($pageid){
$query="SELECT thLid,thlDescription,Content,mainCatId,subCategorieId,visible FROM thirdlevelgroup  where thLid=".$pageid;
$result= mysqli_query($link, $query) or die(mysql_error());
$count = mysqli_num_rows($result);
    if($count > 0){  
?>
<div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
               
  <?php
 $i=1;

while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
extract($row);
$selected="";
  ?>
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Third Group Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="thlDescription" id="thlDescription" value="<?php echo strtoupper($thlDescription);?>" placeholder="Third Group Name"/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Third Group Content</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>
                                    <textarea name="Content" class="form-control" id="Content" cols="30" rows="10"   required ><?php echo $Content;?></textarea>
								</div>
							</div>
                        </div>
                        <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Link With Main Category	</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <?php
                                $sql="SELECT Id,CategorieDescription FROM maincategories ";
                                $result= mysqli_query($link, $sql) or die(mysql_error());
                                $count = mysqli_num_rows($result);
                                ?>
                            <select name="MainCat" id="MainCat">
                            <option value="">Select Main Group</option>

                              <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                  if($row["Id"]==$mainCatId){
                                      $selected="selected";
                                  }else{$selected="";}
                               echo "<option value='".$row["Id"]."'".$selected." >".$row["CategorieDescription"]."</option>";
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
                                <select name="subCat" id="subCat">
                                <opiton value="">Select Sub Group</opiton>
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                                       $selected=($subCategorieId==$row["smId"])? "Selected": "";
                                       
                                   echo "<option value='".$row["smId"]."' ".$selected.">".$row["smDescription"]."</option>";
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
                       
    <?php 
    $i++;
    
    }
    
    ?>
      <div class="form-group ">
                        <input type="hidden" value="<?php echo $_GET['id'];?>" name="Id">
                            <input type="submit" class="btn btn-primary btn-lg " name="Submit" Id="Submit" value="Submit">
                            <a href="EditthirdGroup.php?delete=<?php echo $pageid;?>" class="btn btn-primary btn-lg" style="float: right;" onclick="return confirm('Are you sure you want to delete this item?');" name="Remove" Id="Remove" value="Remove">Remove</a>
						</div>
 
</div>
</div>
</div>
</form>
<?php }
}
?>
			</div>
	
</body>
</html>
