<?php 
include_once("db_connect.php");
include_once("check.php");
?>

<html>
<head>

<script src="./js/bootstrap.min.js" type="application/javascript"></script>
<link rel='stylesheet' type='text/css' href='./css/bootstrap.min.css'>

<script type="application/javascript" language="javascript">

</script>

</head>

<?php require_once("menu.php");?>
<br/>
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy- Show Categories</h1>
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
$sql="SELECT  	CategorieCode,CategorieDescription FROM maincategories";
$result= mysqli_query($link, $sql) or die(mysql_error());
$count = mysqli_num_rows($result);

    if($count > 0){  
   ?>
   <a href="AddMainCategories.php" class="btn btn-primary btn-lg ">Add New Category</a><br/>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
                <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Category Code</th>
      <th>Category Description</th>
      <th>Edit</th>
          </tr>
  </thead>
  <tbody>
  <?php
 $i=1;

while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  
  ?>
    <tr>
      
      <td scope="row"><?php echo $i; ?></td>
      <td><?php echo $row["CategorieCode"];?></td>
      <td><?php echo $row["CategorieDescription"]; ?></td>
      
      <td><a href="#">Edit</a></td>
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
