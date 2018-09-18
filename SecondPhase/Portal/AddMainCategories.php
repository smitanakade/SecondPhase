<?php 

include_once("db_connect.php");
//include_once("check.php");
if(isset($_POST['Submit'])){
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  $CategorieDescription= $_POST['CategorieDescription'];
  $visible= $_POST['visible'];
// Attempt insert query execution
  $sql = "INSERT INTO  maincategories(CategorieDescription,visible) VALUES('".$CategorieDescription."','".$visible."' )";
  //echo $sql;
   if(mysqli_query($link, $sql)){
    header("Location:ViewMainCategory.php");
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

<script type="application/javascript" language="javascript">

</script>

</head>
<?php require_once("menu.php");?>

<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy- Create Main Group</h1>
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
                <form action="" method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
             
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Main Group Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="CategorieDescription" id="Categorie Description"  placeholder="Main Group Name"/>
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
