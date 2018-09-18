<?php
//load the database configuration file
include 'db_connect.php';
//include_once('check.php');

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Members data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
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

			//Remove all existing entries in database.
			$link->query("DELETE FROM userdetails");


            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){

				/*
                //check whether member already exists in database with same EmployeeNo
                $prevQuery = "SELECT EmployeeNo FROM userdetails WHERE EmployeeNo = '".$line[0]."'";
                $prevResult = mysqli_query($link, $prevQuery);
				$numRows = mysqli_num_rows($prevResult);
                if($numRows > 0){
                    //update member data
                    $link->query("UPDATE userdetails SET NameReport = '".mysqli_real_escape_string($link, $line[1])."', EmpStatus = '".mysqli_real_escape_string($link, $line[2])."', EmpStatDesc = '".mysqli_real_escape_string($link, $line[3])."', OccStateCode = '".mysqli_real_escape_string($link, $line[4])."', AdminDesc = '".mysqli_real_escape_string($link, $line[5])."' WHERE EmployeeNo = '".mysqli_real_escape_string($link, $line[0])."'");
                }else{
				*/


                    //insert member data into database

                    //die();
                    $insert_query="INSERT INTO userdetails (EmployeeNo, NameReport, EmpStatus, EmpStatDesc, OccStateCode, AdminDesc,Department,updateOn) VALUES ('".mysqli_real_escape_string($link, $line[0])."','".mysqli_real_escape_string($link, $line[1])."','".mysqli_real_escape_string($link, $line[2])."','".mysqli_real_escape_string($link, $line[3])."','".mysqli_real_escape_string($link, $line[4])."','".mysqli_real_escape_string($link, $line[5])."','".mysqli_real_escape_string($link, $line[6])."',NOW())";
                   //echo $insert_query;
                    $link->query($insert_query);
                //},'".mysqli_real_escape_string($link, $line[5])."')");
                //}
            }

            //close opened csv file
            fclose($csvFile);
            $_SESSION['message']="Members data has been inserted successfully.";

        }else{
            $_SESSION['message']='Some problem occurred, please try again.';
        }
    }else{
      $_SESSION['message']='Please upload a valid CSV file.';
    }
}?>



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
	.left_float input{
	  float:left;
	}

	</style>


</head>

<body>
<?php include_once('menu.php');?>

<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Myer Academy - Import Users from CSV</h1>
	               		<hr />
	               	</div>
                </div>
            <div>



<div class="container">
    <?php if(isset($_SESSION)){
        echo '<div style="font-size:bold;color:red;" >'.$_SESSION['message'].'</div>';
    } ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="ImportUser.php" method="post" enctype="multipart/form-data" id="importFrm">
			<div class="left_float">
        <h4>BULK UPDATE USER DATABASE</h4>
       <span>To bulk update the Myer Academy user database: <br/><br/>
     <b>Step 1:</b> Go to Discoverer and export the GA_MyerAcademy_Access20170215 list as an XLS file. <br>
     Contact HR Systems if you do not have Discoverer access. <br/><br/></span>
      <span><b>Step 2:</b> Convert the XLS to CSV format and upload here: <br/><br/>
                <input type="file" name="file" /><br/><br/>
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                <br/><br/></span>
      <span><br/><br/>To extract the existing list of Myer Academy users: <br/><br/>	</span>
                <a href="export.php?type=userdetails" class="btn btn-primary" name="exportUser" >EXPORT USER LIST</a>
			</div>
            </form>
			<br><br>




        </div>
    </div>
</div>

</body>
