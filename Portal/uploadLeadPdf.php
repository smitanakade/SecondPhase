<?php 

include_once("db_connect.php");

?>
<!DOCTYPE html>
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

</head>
<?php require_once("menu.php");?>

	
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Leader Portal Upload & Assign PDF</h1>
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
                <label for="name" class="cols-sm-2 control-label">Upload PDF</label>
                <div class="cols-sm-10">
                
                    <div class="input-group">
                    <input type="file" name="imageFile" id="imageFile" accept="image/*"/>
                            
                        </select>
                    </div>
                </div>
            </div>
            
        
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">PDF Description	</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="PdfDescription" id="PdfDescription"  placeholder="PdfDescription"/>
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
                                    $sql="SELECT ID,Category FROM leadermaincat";
                                    $result= mysqli_query($link, $sql) or die(mysql_error());
                                    $count = mysqli_num_rows($result);
                                    ?>
                                <select name="MainCat" id="MainCat">
								<option value="">Select Main Category</option>
                                  <?php   while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {

                                   echo "<option value='".$row["ID"]."'>".$row["Category"]."</option>";
                                  }?>
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
