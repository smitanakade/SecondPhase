<?php
include_once("db_connect.php");
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
	               		<h2 class="title">Myer Academy and People Leader Menu</h2>
	               		<hr />
	               	</div>
                </div> 
            <div>
            <?php 
include("db_connection.php");
$query="SELECT m.CategorieDescription as MainGroup,s.smDescription as SubGroup,t.thlDescription as Thirdgroup From maincategories as m LEFT JOIN subMainCategory as s on s.mainCatId = m.Id LEFT JOIN thirdlevelgroup as t on t.mainCatId = m.Id and t.subCategorieId= s.smId";
$result= mysqli_query($link, $query) or die(mysql_error());
$count = mysqli_num_rows($result);
    if($count > 0){  
?>
<div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
                <table class="table table-bordered table-hover">
  <thead>
  <tr><th colspan="7">Showing  <?php echo $count?> Results</th></tr>
    <tr>
      <th>#</th>
      <th>Main Group</th>
      <th>Sub Group</th>
      <th>Third Group</th>
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
      <td><?php echo $row["MainGroup"];?></td>
      <td><?php echo $row["SubGroup"]; ?></td>
      <td><?php echo $row["Thirdgroup"];?></td>
     
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
<?php } ?>
			</div>
	
</body>
</html>
