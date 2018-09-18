<?php 

include_once("db_connect.php");
//include_once("check.php");
if(isset($_POST['Submit'])){
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
// Attempt insert query execution
  $sql = "INSERT INTO userdetails(EmployeeNo, NameReport, EmpStatus, EmpStatDesc, OccStateCode, AdminDesc,Department,updateOn) VALUES('".mysqli_real_escape_string($link, $_POST['EmployeeNo'])."','".mysqli_real_escape_string($link, $_POST['NameReport'])."','".mysqli_real_escape_string($link, $_POST['EmpStatus'])."','".mysqli_real_escape_string($link, $_POST['EmpStatDesc'])."','".mysqli_real_escape_string($link, $_POST['OccStateCode'])."','".mysqli_real_escape_string($link, $_POST['AdminDesc'])."','".mysqli_real_escape_string($link, $_POST['Department'])."',NOW() )";
  
  if(mysqli_query($link, $sql)){
      $_SESSION['Error']="Records inserted successfully.";
  } else{
	  $_SESSION['Error'] = "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	  
     // Close connection
  mysqli_close($link);
}
}

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
	<style>
	
	
	</style>
	

</head>

<script type="application/javascript" language="javascript">
var $form = $("form"),
$successMsg = $(".alert");

$form.on("submit", function(e) {
if ($form.validatr("validateForm")) {
  e.preventDefault();
  $successMsg.show();
}
});</script>

</head>
<body>
<?php include_once('menu.php');?>
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy- Registration Form</h1>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;">	<?php		if( isset($_SESSION['Error']) )
{
        echo $_SESSION['Error'];
        unset($_SESSION['Error']);

}?></div>
                <div class="main-login main-center">
                <form action="" method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
                <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="NameReport" id="NameReport"  placeholder="Name" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Employee Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="EmployeeNo" id="EmployeeNo" pattern="\d*" placeholder="Employee Number" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Employee Status</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="EmpStatus" id="EmpStatus"  placeholder="Employee Status" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Employee Status Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-reply" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="EmpStatDesc" id="EmpStatDesc"  placeholder="Employee Status Description" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">State Code</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
									<select id="OccStateCode" name="OccStateCode" class="form-control">
										<option value="">Select location</option>
										<option value="VIC">VIC</option>
										<option value="QLD">QLD</option>
										<option value="NSW">NSW</option>
										<option value="SA">SA</option>
										<option value="WA">WA</option>
									</select>
								</div>
							</div>
                        </div>
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">AdminDesc</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="AdminDesc" id="AdminDesc"  placeholder="Location" required/>
								</div>
							</div>
						</div>       <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Department</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-universal-access" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="Department" id="Department"  placeholder="Access" required/>
								</div>
							</div>
						</div>          

                        <div class="form-group ">
                            <input type="submit" class="btn btn-primary btn-lg btn-block login-button" 	name="Submit" Id="Submit" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
    
</body>
</html>
