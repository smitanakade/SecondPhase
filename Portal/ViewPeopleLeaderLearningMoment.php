<?php 
include_once("db_connect.php");
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
          $updatedRow="";
          $pattern="/^'/";
          $replacement="&#8217;";
          //parse data from csv file line by line
          while(($line = fgetcsv($csvFile)) !== FALSE){
            $jsonString = "../Leader/content/".$line['5']."/course/en/contentObjects.json";
            $json = file_get_contents($jsonString);
            $array_json = json_decode($json, True);
             $pageId=$array_json[0]["_id"];  
             $Title=(preg_match($pattern, $line[2]) )? preg_replace($pattern, $replacement, $line[2]): $line[2] ;
             $series=(preg_match($pattern, $line[3]) )? preg_replace($pattern, $replacement, $line[3]): $line[3] ;
             $strapline=(preg_match($pattern, $line[4]) )? preg_replace($pattern, $replacement, $line[4]): $line[4] ;
             $articalFolder=(preg_match($pattern, $line[5]) )? preg_replace($pattern, $replacement, $line[5]): $line[5] ;
             $Description=(preg_match($pattern, $line[6]) )? preg_replace($pattern, $replacement, $line[6]): $line[6] ;
             $Links=(preg_match($pattern, $line[7]) )? preg_replace($pattern, $replacement, $line[7]): $line[7] ;
             $MainCategory=(preg_match($pattern, $line[8]) )? preg_replace($pattern, $replacement, $line[8]): $line[8] ;
             $category=(preg_match($pattern, $line[9]) )? preg_replace($pattern, $replacement, $line[9]): $line[9] ;
            //  $Filter=(preg_match($pattern, $line[10]) )? preg_replace($pattern, $replacement, $line[10]): $line[10] ;
             $CapabilityTag=(preg_match($pattern, $line[10]) )? preg_replace($pattern, $replacement, $line[10]): $line[10] ;
             $TopicSearchTags=(preg_match($pattern, $line[11]) )? preg_replace($pattern, $replacement, $line[11]): $line[11] ;
             $Keyword=(preg_match($pattern, $line[12]) )? preg_replace($pattern, $replacement, $line[12]): $line[12] ;
             $SecondaryLeadership=(preg_match($pattern, $line[13]) )? preg_replace($pattern, $replacement, $line[13]): $line[13] ;
             $pageRanking=(preg_match($pattern, $line[14]) )? preg_replace($pattern, $replacement, $line[14]): $line[14] ;
             $imageName =(preg_match($pattern, $line[15]) )? preg_replace($pattern, $replacement, $line[15]): $line[15] ;
              //check whether member already exists in database with same EmployeeNo
          //   echo $Title."-".$series."-".$strapline."-".$articalFolder."-".$Description."-".$Links."-".$MainCategory."-".$category."-".$Filter."-".$CapabilityTag."-".$TopicSearchTags."-".$Keyword;
              $prevQuery = "SELECT Title FROM leaderlearningmoment WHERE Id = '".mysqli_real_escape_string($link,$line[0])."'";
              $prevResult = mysqli_query($link, $prevQuery);
              $numRows = mysqli_num_rows($prevResult);
              if($numRows > 0){
                  $updateLM= "UPDATE leaderlearningmoment SET pageId='".mysqli_real_escape_string($link,$pageId)."', Title='".mysqli_real_escape_string($link, $Title)."', series='".mysqli_real_escape_string($link, $series)."', strapline='".mysqli_real_escape_string($link, $strapline)."', articalFolder='".mysqli_real_escape_string($link, $articalFolder)."', Description='".mysqli_real_escape_string($link, $Description)."', imageName='".mysqli_real_escape_string($link, $imageName)."',MainCategory='".mysqli_real_escape_string($link,$MainCategory)."', category='".mysqli_real_escape_string($link, $category)."',CapabilityTag='".mysqli_real_escape_string($link, $CapabilityTag)."', TopicSearchTags='".mysqli_real_escape_string($link, $TopicSearchTags)."', Keyword='".mysqli_real_escape_string($link, $Keyword)."', SecondaryLeadership='".mysqli_real_escape_string($link, $SecondaryLeadership)."', pageRanking='".mysqli_real_escape_string($link, $pageRanking)."', imageName='".mysqli_real_escape_string($link, $imageName)."', updateOn=NOW() WHERE Id='".mysqli_real_escape_string($link, $line[0])."' "; 
                  // echo $updateLM;
                      $link->query($updateLM);//update member data            
                  // $link->query("UPDATE leaderlearningmoment SET series='".mysqli_real_escape_string($link, $line[1])."',strapline= '".mysqli_real_escape_string($link, $line[2])."',Description= '".mysqli_real_escape_string($link, $line[3])."',Links= '".mysqli_real_escape_string($link, $line[4])."',ActivityDuration= '".mysqli_real_escape_string($link, $line[5])."',MainCategory='".mysqli_real_escape_string($link,$line[6])."',Category= '".mysqli_real_escape_string($link, $line[6])."',Filter= '".mysqli_real_escape_string($link, $line[7])."',CapabilityTag= '".mysqli_real_escape_string($link, $line[8])."',TopicSearchTags= '".mysqli_real_escape_string($link, $line[9])."',Keyword= '".mysqli_real_escape_string($link, $line[10])."',SecondaryLeadership= '".mysqli_real_escape_string($link, $line[11])."',pageRanking= '".mysqli_real_escape_string($link, $line[12])."',imageName= '".mysqli_real_escape_string($link, $line[13])."',updateOn=now() WHERE Id = '".mysqli_real_escape_string($link, $line[0])."' ");
              }else{
               $insertQuery= "INSERT INTO leaderlearningmoment (pageId, Title, series, strapline, articalFolder, Description, MainCategory, category, CapabilityTag, TopicSearchTags, Keyword, SecondaryLeadership, pageRanking, imageName, updateOn) VALUES ('".mysqli_real_escape_string($link, $pageId)."','".mysqli_real_escape_string($link, $Title)."','".mysqli_real_escape_string($link, $series)."','".mysqli_real_escape_string($link, $strapline)."','".mysqli_real_escape_string($link, $articalFolder)."','".mysqli_real_escape_string($link, $Description)."','".mysqli_real_escape_string($link, $MainCategory)."','".mysqli_real_escape_string($link, $category)."','".mysqli_real_escape_string($link, $CapabilityTag)."','".mysqli_real_escape_string($link, $TopicSearchTags)."','".mysqli_real_escape_string($link, $Keyword)."','".mysqli_real_escape_string($link, $SecondaryLeadership)."','".mysqli_real_escape_string($link, $pageRanking)."','".mysqli_real_escape_string($link,$imageName)."',now())";
               //echo $insertQuery; 
               $link->query($insertQuery);
              }
          }
          
          //close opened csv file
          fclose($csvFile);

          $_SESSION['message']="SUCCESS: Data has been inserted successfully.";
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
	               		<h2 class="title">People Leader Portal - View Learning Moments</h2>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;"><strong>	<?php		if( isset($_SESSION['Error']) )
{
        echo $_SESSION['message'];
        unset($_SESSION['message']);

}?></strong>
</div><br/>
                <div class="main-login main-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data" id="importFrm">
               <?php 

//$sql="SELECT ID,pageId,Title,series,strapline,articalFolder,Description,Links,category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,pageRanking,imageName,updateOn  FROM leaderlearningmoment ORDER By pageRanking";
$sql="SELECT ID,pageId,Title,series,strapline,articalFolder,Description,imageName,category,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,pageRanking,imageName,updateOn  FROM leaderlearningmoment ORDER By pageRanking";
$result= mysqli_query($link, $sql) or die(mysql_error());
$count = mysqli_num_rows($result);

  
   ?>
 <h4>BULK UPDATE LEARNING MOMENTS</h4>
  <span>To bulk update Learning Moment information: <br/><br/>
<strong>Step 1</strong>: Export learning moment information to CSV.<br/><br/></span>
<a href="export.php?type=leaderlearningmoment" class="btn btn-primary">EXPORT TO CSV</a><br/><br/>
 <span><strong>Step 2</strong>: Once you've updated the CSV, select the file and import.<br/><br/></span>					
    <div class="left_float">
    <input type="file" name="file" /><br/><input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT"><br/><br/>
    </div>
 <?php  if($count > 0){  ?>
					
<h4>UPDATE A LEARNING MOMENT</h4>		 
<span>Select the <strong>Page Title</strong> to edit the details for any Learning Moment.</span><br/><br/>
     <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
                <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>series</th>
      <th>strapline</th>
      <th>articalFolder</th>
      <th>Description</th>
    <th>Uploaded Image</th>
      <th>category</th>

      <th>CapabilityTag</th>
      <th>TopicSearchTags</th>
      <th>Keyword</th>
      <th>SecondaryLeadership</th>
      <th>pageRanking</th>
      <th>updateOn</th>
          </tr>
  </thead>
  <tbody>
  <?php
 $i=1;

while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
  
  ?>
    <tr>
      
       <td scope="row"><?php echo $i; ?></td>
      <td><a href="EditLeaderLM.php?id=<?php echo $row['ID'];?>"><?php echo $row["Title"];?></a></td>
      <td><?php echo $row["series"]; ?></td>
      <td><?php echo $row["strapline"]; ?></td>
      <td><?php echo $row["articalFolder"];?></td>
      <td><?php echo $row["Description"];?></td>
      <td><?php echo $row["imageName"]; ?></td>
      <td><?php echo $row["category"]; ?></td>
      <td><?php echo $row["CapabilityTag"]; ?></td>
      <td><?php echo $row["TopicSearchTags"];?></td>
      <td><?php echo $row["Keyword"]; ?></td>
      <td><?php echo $row["SecondaryLeadership"]; ?></td>
      <td><?php echo $row["pageRanking"]; ?></td>
      <td><?php echo $row["updateOn"]; ?></td>
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
    <?php if(isset($_POST['submit'])){
        print_r($_REQUEST);
        }
        ?>
</body>
</html>
