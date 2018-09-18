<?php 
include_once("db_connect.php");
//include_once("check.php");
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
	               		<h2 class="title">Myer Academy- Registerd User</h2>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;">	<?php	
if( isset($_SESSION['Error']) )
{
        echo $_SESSION['Error'];
        unset($_SESSION['Error']);

}
if(isset($_SESSION['message']) )
{        echo $_SESSION['message'];
        unset($_SESSION['message']);

}
?></div>
                <div class="main-login main-center">
                <form action="" method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
                <?php 
$sql="SELECT thLid,thlDescription, m.CategorieDescription as mainCat,s.smDescription as subCat FROM thirdlevelgroup as th LEFT JOIN maincategories as m on th.mainCatId= m.Id LEFT JOIN submaincategory as s on th.subCategorieId = s.smId";
$result= mysqli_query($link, $sql) or die(mysql_error());
$count = mysqli_num_rows($result);

     
   ?>
   <a href="AddSubCategories.php" class="btn btn-primary btn-lg ">Add Page</a><br/><br/>
   <?php  if($count > 0){?>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
                <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Third Level Group</th>
      <th>Main Group</th>
      <th>Sub Group</th>
      <th>Edit</th>
          </tr>
  </thead>
  <tbody>
  <?php
 $i=1;

while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  extract($row)
  ?>
    <tr>
      <td scope="row"><?php echo $i; ?></td>
      <td><?php echo $thlDescription; ?></td>
      <td><?php echo $mainCat;?></td>
      <td><?php echo $subCat; ?></td>
      <td><a href="EditThirdLevel.php?id=<?php echo $thLid;?>">Edit</a></td>
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
              echo"\n No Record Found! Please Add New Page";  
            } 
?>         
					</form>
				</div>
			</div>
		</div>
    
</body>
</html>
