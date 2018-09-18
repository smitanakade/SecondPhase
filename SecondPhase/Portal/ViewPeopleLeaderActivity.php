<?php 
include_once("db_connect.php");
session_start();
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
    <script type="text/javascript">
   function validate(){
       alert('hello');
    }
</script>
</head>
<body>
<?php require_once("menu.php");?>
<br/>
<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">People Leader Portal - View Activities </h2>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<?php		if( isset($_SESSION['Error']) )
{
        echo $_SESSION['message'];
        unset($_SESSION['message']);

}?>

<div class="main-login main-center">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  onsubmit="return validate()" method="post" enctype="multipart/form-data" id="importFrm">
               <?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    //validate whether uploaded file is a csv file
    if(empty($_FILES['file']['name']){
        echo "ERROR: Please upload a valid CSV file";
        $_SESSION['message']="ERROR: Please upload a valid CSV file";

    }else{
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
                if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
                    //open uploaded csv file with read only mode
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                    //skip first line
                    fgetcsv($csvFile);
                    $i=0;
                    $updatedRow="";
                    $pattern="/^'/";
                    $replacement="&#8217;";
                    //parse data from csv file line by line
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                    // check whether member already exists in database with same email
                    $prevQuery = "SELECT ID FROM leaderassociation WHERE ID = '".mysqli_real_escape_string($link,$line[0])."'";
                        $prevResult = mysqli_query($link, $prevQuery) or die(mysql_error());
                        $count = mysqli_num_rows($prevResult);
                    if($line[1]!=""){
                        $updatedRow.=$line[1]."<br/>";
                        $Title=(preg_match($pattern, $line[1]) )? preg_replace($pattern, $replacement, $line[1]): $line[1] ;
                        $series=(preg_match($pattern, $line[2]) )? preg_replace($pattern, $replacement, $line[2]): $line[2] ;
                        $strapline=(preg_match($pattern, $line[3]) )? preg_replace($pattern, $replacement, $line[3]): $line[3] ;
                        $Description=(preg_match($pattern, $line[4]) )? preg_replace($pattern, $replacement, $line[4]): $line[4] ;
                        $Links=(preg_match($pattern, $line[5]) )? preg_replace($pattern, $replacement, $line[5]): $line[5] ;
                        $ActivityDuration=(preg_match($pattern, $line[6]) )? preg_replace($pattern, $replacement, $line[6]): $line[6] ;
                        $MainCategory=(preg_match($pattern, $line[7]) )? preg_replace($pattern, $replacement, $line[7]): $line[7] ;
                        $Category=(preg_match($pattern, $line[8] ))? preg_replace($pattern, $replacement, $line[8]): $line[8] ;
                        $Filter=(preg_match($pattern, $line[9]) )? preg_replace($pattern, $replacement, $line[9]): $line[9] ;
                        $CapabilityTag= (preg_match($pattern, $line[10]) )? preg_replace($pattern, $replacement, $line[10]): $line[10] ;
                        $TopicSearchTags=(preg_match($pattern, $line[11]) )? preg_replace($pattern, $replacement, $line[11]): $line[11] ;
                        $Keyword=(preg_match($pattern, $line[12]) )? preg_replace($pattern, $replacement, $line[12]): $line[12] ;
                        $SecondaryLeadership=(preg_match($pattern, $line[13]) )? preg_replace($pattern, $replacement, $line[13]): $line[13] ;
                        $pageRanking=(preg_match($pattern, $line[14]) )? preg_replace($pattern, $replacement, $line[14]): $line[14] ;
                        $imageName=(preg_match($pattern, $line[15]) )? preg_replace($pattern, $replacement, $line[15]): $line[15] ;
                        if($count > 0){
                            //update member data
                            $updateQuery="UPDATE leaderassociation SET Title = '".mysqli_real_escape_string($link,$Title)."', series = '".mysqli_real_escape_string($link,$series)."', strapline = '".mysqli_real_escape_string($link,$strapline)."', Description = '".mysqli_real_escape_string($link,$Description)."', Links = '".mysqli_real_escape_string($link,$Links)."',ActivityDuration= '".mysqli_real_escape_string($link,$ActivityDuration)."',MainCategory='".mysqli_real_escape_string($link,$MainCategory)."',Category= '".mysqli_real_escape_string($link,$Category)."',Filter= '".mysqli_real_escape_string($link,$Filter)."',CapabilityTag= '".mysqli_real_escape_string($link,$CapabilityTag)."',TopicSearchTags= '".mysqli_real_escape_string($link,$TopicSearchTags)."',Keyword= '".mysqli_real_escape_string($link,$Keyword)."',SecondaryLeadership= '".mysqli_real_escape_string($link,$SecondaryLeadership)."',pageRanking= '".mysqli_real_escape_string($link,$pageRanking)."',imageName= '".mysqli_real_escape_string($link,$imageName)."',updateOn=NOW() WHERE ID = '".mysqli_real_escape_string($link,$line[0])."'";
                        // echo $updateQuery;
                        $result= mysqli_query($link, $updateQuery) or die(mysql_error());               
                        }else{
                            //insert member data into database
                            $insertQuery="INSERT INTO leaderassociation (Title,series,strapline,Description,Links,ActivityDuration,MainCategory,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,pageRanking,imageName,updateOn) VALUES ('".mysqli_real_escape_string($link,$Title)."','".mysqli_real_escape_string($link,$series)."','".mysqli_real_escape_string($link,$strapline)."','".mysqli_real_escape_string($link,$Description)."','".mysqli_real_escape_string($link,$Links)."','".mysqli_real_escape_string($link,$ActivityDuration)."','".mysqli_real_escape_string($link,$MainCategory)."','".mysqli_real_escape_string($link,$Category)."','".mysqli_real_escape_string($link,$Filter)."','".mysqli_real_escape_string($link,$CapabilityTag)."','".mysqli_real_escape_string($link,$TopicSearchTags)."','".mysqli_real_escape_string($link,$Keyword)."','".mysqli_real_escape_string($link,$SecondaryLeadership)."','".mysqli_real_escape_string($link,$pageRanking)."','".mysqli_real_escape_string($link,$imageName)."',NOW())";
                        // echo $insertQuery;
                        $result= mysqli_query($link, $insertQuery) or die(mysql_error());               
                        
                        }
                    }
                    $i++;
                    }
                    
                    //close opened csv file
                    fclose($csvFile);
                    echo "Total Number of Rows updated ".$i." and Title of those Rows are as following";
                    echo "<br/>".$updatedRow;
                    echo "<a href='/Portal/ViewPeopleLeaderActivity.php'>Click here to view All updates </a>";
                    
                }
            }
    }


   
}
else{
$sql="SELECT ID,Title,series,strapline,Description,Links,ActivityDuration,Category,Filter,CapabilityTag,TopicSearchTags,Keyword,SecondaryLeadership,pageRanking,imageName,updateOn FROM leaderassociation ORDER By pageRanking";
$result= mysqli_query($link, $sql) or die(mysql_error());
$count = mysqli_num_rows($result);

   ?>
    <div class="left_float">
	<h4>BULK UPDATE ACTIVITIES</h4>	
	<span>To bulk update Learning Moment information: <br/><br/><strong>Step 1</strong>: Export learning moment information to CSV.<br/><br/></span>
	<a href="export.php?type=leaderassociation" class="btn btn-primary">EXPORT TO CSV</a><br/><br/>
   
	<span><strong>Step 2</strong>: Once you've updated the CSV, select the file and import.<br/><br/>
	<input type="file" name="file" /><br/><input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
    </div><br/><br/>
    <?php     if($count > 0){  
?>
<h4>UPDATE PEOPLE LEADER ACTIVITY</h4>		
<span>Select the <strong>Activity Title</strong> to edit the details for any People Leader Portal Activity.</span><br/><br/>
<div style="font-size=20; color:#FF0000;"><span>NOTE*: FOR PEOPLE LEADER PORTAL ACTIVITIES, THERE IS NO NEED TO UPLOAD IMAGES.<br/> JUST SELECT THE IMAGE NAME LIKE <strong>"READ.png,	
	LISTEN.png,WATCH.png,DO.png" </strong>TO THE RESPECTIVE ACTIVITY</span><br/><br/></div>	
     <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
      <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>ActivityTitle</th>
      <th>series</th>
      <th>strapline</th>
      <th>Description</th>
      <th>ActivityDuration</th>
      <th>Activity</th>
      <th>CapabilityTag</th>
      <th>TopicSearchTags</th>
      <th>Keyword</th>
      <th>PrimaryLeadershipCategory</th>
      <th>SecondaryLeadership</th>
      <th>pageRanking</th>
      <th>imageName</th>
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
      <td><a href="EditLeaderArtical.php?id=<?php echo $row['ID'];?>"><?php echo $row["Title"];?></a></td>
      <td><?php echo $row["series"]; ?></td>
      <td><?php echo $row["strapline"]; ?></td>
      <td><?php echo $row["Description"];?></td>
      <td><?php echo $row["ActivityDuration"];?></td>
      <td><?php echo $row["Filter"]; ?></td>
      <td><?php echo $row["CapabilityTag"]; ?></td>
      <td><?php echo $row["TopicSearchTags"]; ?></td>
      <td><?php echo $row["Keyword"]; ?></td>
      <td><?php echo $row["Category"];?></td>
      <td><?php echo $row["SecondaryLeadership"]; ?></td>
      <td><?php echo $row["pageRanking"]; ?></td>
      <td><?php echo $row["imageName"]; ?></td>
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
