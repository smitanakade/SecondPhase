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
<body>
<?php require_once("menu.php");?>
<br/>
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy - View Registered Users</h2>
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
                <?php
$sql="SELECT EmployeeNo,NameReport,EmpStatus,EmpStatDesc,OccStateCode,AdminDesc,Department,updateOn FROM userdetails ";
$result= mysqli_query($link, $sql) or die(mysql_error());
$count = mysqli_num_rows($result);
    if($count > 0){
   ?>

   <span><h4>ADD NEW USER</h4>
     To add a single new user: <br/><br/></span>
   <a href="RegisterUser.php" class="btn btn-primary">ADD NEW USER</a> <br/><br/>
   <span><h4>EXPORT CURRENT USERS</h4>
     To export all current Myer Academy users to a CSV file: <br><br></span>
   <a href="export.php?type=userdetails" class="btn btn-primary">EXPORT USERS</a><br/><br/>
   <span><h4>VIEW CURRENT USERS</h4>
     The following table contains current Myer Academy users: <br><br></span>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
                <table class="table table-bordered table-hover">
  <thead>
  <tr><th colspan="7">Showing 50 of <?php echo $count?> Results</th></tr>
    <tr>
      <th>#</th>
      <th>Team Member ID</th>
      <th>Team Member Name</th>
      <th>Status</th>
      <th>State</th>
      <th>State</th>
      <th>Location</th>
      <th>Department</th>
          </tr>
  </thead>
  <tbody>
  <?php
 $i=1;

while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  if($i==51){
    break;
  }
  ?>
    <tr>

      <td scope="row"><?php echo $i; ?></td>
      <td><?php echo $row["EmployeeNo"];?></td>
      <td><?php echo $row["NameReport"]; ?></td>
      <td><?php echo $row["EmpStatus"];?></td>
      <td><?php echo $row["EmpStatDesc"]; ?></td>
      <td><?php echo $row["OccStateCode"]; ?></td>
      <td><?php echo $row["AdminDesc"]; ?></td>
      <td><?php echo $row["Department"]; ?></td>
    </tr>
    <?php
    $i++;

    }

    ?>

  </tbody>
</table>
</div>
</div>
</div>

  <?php

  }
   else{
              echo"No Record Found! Please Add New User";
            }
?>
					</form>
				</div>
			</div>
		</div>

</body>
</html>
