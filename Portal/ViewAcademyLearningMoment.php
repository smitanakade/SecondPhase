<?php 
include_once("db_connect.php");
//include_once("check.php");

session_start();

if(isset($_POST['importSubmit'])){
  
  //validate whether uploaded file is a csv file
  $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
  if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
      if(is_uploaded_file($_FILES['file']['tmp_name'])){
          
          //open uploaded csv file with read only mode
          $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
          
          //skip first line
          fgetcsv($csvFile);
    
          //parse data from csv file line by line
          while(($line = fgetcsv($csvFile)) !== FALSE){
            
            $jsonString = "../content/".mysqli_real_escape_string($link,$line['5'])."/course/en/contentObjects.json";
            $json = file_get_contents($jsonString);
            $array_json = json_decode($json, True);
             $pageId=$array_json[0]["_id"];  
           
              //check whether member already exists in database with same EmployeeNo
              $prevQuery = "SELECT * FROM academyLM WHERE Id = '".$line[0]."' ";
          //    echo $prevQuery;
              $prevResult = mysqli_query($link, $prevQuery);
              $numRows = mysqli_num_rows($prevResult);
              if($numRows > 0){
                  //update member data
                  $update="UPDATE academyLM SET pageId='".mysqli_real_escape_string($link,$pageId)."',PageTitle='".mysqli_real_escape_string($link,$line[2])."',series='".mysqli_real_escape_string($link,$line[3])."',strapline='".mysqli_real_escape_string($link,$line[4])."',articalFolder='".mysqli_real_escape_string($link,$line[5])."',pageDescription='".mysqli_real_escape_string($link,$line[6])."',keyword='".mysqli_real_escape_string($link,$line[7])."',MainCategory='".mysqli_real_escape_string($link,$line[8])."',SubCategory='".mysqli_real_escape_string($link,$line[9])."',ThirdLevelCategory='".mysqli_real_escape_string($link,$line[10])."',pageRanking='".mysqli_real_escape_string($link,$line[11])."',ImageName='".mysqli_real_escape_string($link,$line[12])."',DisplayKeywords='".mysqli_real_escape_string($link,$line[13])."',updatedon=NOW() WHERE Id='".mysqli_real_escape_string($link,$line[0])."'";                   
                  // echo  $update;
                   $link->query($update);
              }else{
      
                  $insert="INSERT INTO academyLM (pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory,ThirdLevelCategory,pageRanking,ImageName,DisplayKeywords,updatedon ) VALUES ('".mysqli_real_escape_string($link, $pageId)."','".mysqli_real_escape_string($link, $line[2])."','".mysqli_real_escape_string($link, $line[3])."','".mysqli_real_escape_string($link, $line[4])."','".mysqli_real_escape_string($link, $line[5])."','".mysqli_real_escape_string($link, $line[6])."','".mysqli_real_escape_string($link, $line[7])."','".mysqli_real_escape_string($link, $line[8])."','".mysqli_real_escape_string($link, $line[9])."','".mysqli_real_escape_string($link, $line[10])."','".mysqli_real_escape_string($link, $line[11])."','".mysqli_real_escape_string($link, $line[12])."','".mysqli_real_escape_string($link, $line[13])."',now())";
              // echo $insert;
                  $link->query($insert);
              }
          }
          
          //close opened csv file
          fclose($csvFile);

          $_SESSION['message']="SUCCESS: Academy data has been inserted successfully.";
        }else{
            $_SESSION['message']='ERROR: Some problem occurred, please try again.';
        }
  }else{
    $_SESSION['message']='ERROR: Please upload a valid CSV file.';
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
</head>
<body>
<?php require_once("menu.php");?>
<br/>
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy - View Learning Moments </h2>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;" ><strong><?php	

if(isset($_SESSION['message']) )
{        echo $_SESSION['message'];
        unset($_SESSION['message']);

}
?></strong></div><br/>
                <div class="main-login main-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data"   name="RegForm" id="RegForm">
                <?php 
$sql="SELECT Id,pageId,PageTitle,series,strapline,articalFolder,pageDescription,keyword,MainCategory,SubCategory,ThirdLevelCategory,pageRanking,ImageName,DisplayKeywords,updatedon  FROM academyLM";
$result= mysqli_query($link, $sql) or die(mysql_error());
$count = mysqli_num_rows($result);
     
     
   ?>
<table class="table table-bordered table-hover">
	<tr>
	  <td>
	 <h4>ADD NEW LEARNING MOMENT</h4>				
	<span>To add a new learning moment:</span><br/><br/>
   <a href="AddAcademyLM.php" class="btn btn-primary">ADD PAGE</a><br/><br/>
   <?php  if($count > 0){?>
      </td>
	<td> 
   <h4>BULK UPDATE LEARNING MOMENTS</h4>
  <span>To bulk update Learning Moment information: <br/><br/>
Step 1: Export learning moment information to CSV.<br/><br/></span>	
<a href="export.php?type=academyLM" class="btn btn-primary">EXPORT TO CSV</a><br/><br/>
 <span>Step 2: Once you've updated the CSV, select the file and import.<br/><br/></span><input type="file" name="file" /><br/><input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT"><br/><br/>
	</td> 
	</tr>
</table><br/>
<h4>UPDATE A LEARNING MOMENT</h4>		 
<span>Select the <strong>Page Title</strong> to edit the details for any Learning Moment.</span><br/>
<table class="table table-bordered table-hover">
<table class="table table-bordered table-hover">
  <thead>
      <tr>
      <th>#</th>
      <th>Page Title</th><br/>
      <th>Series</th>
      <th>Strapline</th>
      <th>Folder Name</th>
      <th>Description</th>
      <th>Keyword</th>
      <th>Main Group</th>
      <th>Sub Group</th>
      <th>Third Level Group</th>
      <th>Page Order</th>
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
      <td><a href="pageUpdate.php?id=<?php echo $Id;?>"><?php echo $PageTitle;?></a></td>
      <td><?php echo $series; ?></td>
      <td><?php echo $strapline; ?></td>
      <td><?php echo $articalFolder; ?></td>
      <td><?php echo $pageDescription; ?></td>
      <td><?php echo $keyword;?></td>
      <td><?php echo $MainCategory; ?></td>
      <td><?php echo $SubCategory; ?></td>
      <td><?php echo $ThirdLevelCategory; ?></td>
      <td><?php echo $pageRanking;?></td>
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
