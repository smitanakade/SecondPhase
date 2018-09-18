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
	               		<h2 class="title">Myer Academy and People Leader Menu Main Group</h2>
	               		<hr />
	               	</div>
                </div> 
            <div>
            <?php 
include("db_connection.php");
$query="SELECT Id,CategorieDescription,visible FROM maincategories";
$result= mysqli_query($link, $query) or die(mysql_error());
$count = mysqli_num_rows($result);
    if($count > 0){  
?>
<div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
                <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Main Group Name</th>
      <th>Visible</th>
          </tr>
  </thead>
  <tbody>
  <?php
 $i=1;

while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  ?>
    <tr>
      
      <td scope="row"><?php echo $i; ?></td>
      <td><a href="EditMainGroup.php?id=<?php echo  $row["Id"]; ?>"><?php echo $row["CategorieDescription"];?></a></td>
      <td><?php echo $row["visible"]; ?></td>     
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
