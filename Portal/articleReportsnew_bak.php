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
    <form method="post" action="articleEReport.php">
        <div class="container">
            <div class="row main">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h2 class="title">Myer Academy- Article Reports</h2>
                        <hr />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="reporttype" class="col-sm-2">Report Type</label>
                <div class="col-sm-6">
                    <select id="reportname" name="reportname" class="form-control" required>
                        <option value="">Select report type</option>
                        <option value="like">Like report</option>
                        <option value="comments">Comments report</option>
						  <option value="commentslike">Comments like report</option>
						 <option value="pageview">Page view report</option>
						  <option value="useractivity">User activity report</option>
						   <option value="articlepagelike">Article-page like report</option>
						    <option value="articlecomments">Article-comments report</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="startdate" class="col-sm-2">Start date</label>
                <div class="col-sm-2">
                    <input id="startdate" type="date" name="StartDate" class="form-control">
                </div>
                <label for="enddate" class="col-sm-2 text-right">End date</label>
                <div class="col-sm-2 ">
                    <input id="enddate" type="date" name="EndDate" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="location" class="col-sm-2">Location</label>
                <div class="col-sm-6">
                    <select id="location" name="Location" class="form-control">
                        <option value="">Select location</option>
                        <option value="VIC">VIC</option>
                        <option value="QLD">QLD</option>
                        <option value="NSW">NSW</option>
                        <option value="SA">SA</option>
                        <option value="WA">WA</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="department" class="col-sm-2">Department</label>
                <div class="col-sm-6">
                    <select id="department" name="Department" class="form-control">
                        <option value="">Select department</option>
                        <?php

                        $sql = mysqli_query($link, "SELECT distinct(department) FROM userdetails");
                        while ($row = $sql->fetch_assoc()){
                        echo "
                        <option>" . $row['department'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
			     <div class="form-group row">
                <label for="site" class="col-sm-2">Site</label>
                <div class="col-sm-6">
                    <select id="site" name="Site" class="form-control">
					<option value="all">All</option>
						  <option value="leader">People leader</option>
						    <option value="academy">Academy</option>
                    </select>
                </div>
            </div>
			   <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
	    <button id="generatereport" type="button" value="Submit" class="button_cust">Generate Report</button>
		  <input type="submit" name="export" value="CSV Export" class="btn btn-success" />  
						
      </div>
    </div>
 <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive" id="report">

	  </div></div></div>
	  <div>
	  <p id="rowsnotfound" class="font-weight-bold"></p>
	  </div>

        </div>

    </form>
	
</body>
</html>
