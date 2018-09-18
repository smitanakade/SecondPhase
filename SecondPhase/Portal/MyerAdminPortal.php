<?php
include_once("db_connect.php");
include_once("check.php");
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
	               		<h2 class="title">Welcome to the Myer Academy and People Leader Admin Portal</h2>
	               		<hr />
	               	</div>
                </div> 
            <div class="row main">
<table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">
  <tbody>
    <tr>
      <td width="32%" valign="top" align="center">
      <h4>Manage menu</h4>
       		<ul>
		    <li><a href="http://myeracademy.com.au/Portal/MenuCategory.php" target="_self">View all menu groups</a><br><br></li>
			<li><a href="http://myeracademy.com.au/Portal/ViewMainCategory.php" target="_self">Edit main menu groups</a></li>
			<li><a href="http://myeracademy.com.au/Portal/ViewSubGroup.php" target="_self">Edit sub menu groups</a></li>
			<li><a href="http://myeracademy.com.au/Portal/ViewThirdGroup.php" target="_self">Edit third level menu groups<br><br></a></li>
			<li><a href="http://myeracademy.com.au/Portal/AddMainCategories.php" target="_self">Create new main menu group</a></li>
			<li><a href="http://myeracademy.com.au/Portal/addSubMainGroup.php" target="_self">Create new sub menu group</a></li>
			<li><a href="http://myeracademy.com.au/Portal/thirdLevelCat.php" target="_self">Create new third menu group</a></li>
		</ul>
	  </td>
		<td width="2%">&nbsp;&nbsp;</td>
      <td width="32%" valign="top" align="center">
		  <h4>Manage MyerAcademy</h4>
		  <ul>
		    <li><a href="http://myeracademy.com.au/Portal/ViewAcademyLearningMoment.php" target="_self">View all MyerAcademy learning moments</a></li>
			<li><a href="http://myeracademy.com.au/Portal/ViewMainCategory.php" target="_self">Add new MyerAcademy learning moment</a></li>
		</ul>
		  <br>
		<h4>Manage users</h4> 
		  <ul>
		    <li><a href="http://myeracademy.com.au/Portal/ViewUser.php" target="_self">View and edit users</a></li>
			<li><a href="http://myeracademy.com.au/Portal/RegisterUser.php" target="_self">Add new user</a></li>
			<li><a href="http://myeracademy.com.au/Portal/ImportUser.php" target="_self">Bulk import users from CSV</a></li>
		</ul>
	  </td>
		<td width="2%">&nbsp; &nbsp;</td>
      <td width="32%" valign="top" align="center">
		  <h4>Manage People Leader Portal</h4>
		   <ul>
		    <li><a href="http://myeracademy.com.au/Portal/ViewPeopleLeaderActivity.php" target="_self">View all PL Portal activities</a></li>
			<li><a href="http://myeracademy.com.au/Portal/AddPeopleLeaderActivity.php" target="_self">Add new PL Portal activity</a></li>
			<li><a href="http://myeracademy.com.au/Portal/ViewPeopleLeaderLearningMoment.php" target="_self">View all PL Portal learning moments</a></li>
			<li><a href="http://myeracademy.com.au/Portal/AddPeopleLeaderLearningMoment.php" target="_self">Add new PL Portal learning moment</a></li>
		</ul>
		  <br>
		<h4>Reporting</h4>
		  <ul>
		    <li><a href="http://myeracademy.com.au/Portal/Reports.php" target="_self">Run Myer Academy and PL Portal reports</a></li>
		</ul>
		  
	  </td>
    </tr>
    </tbody>
</table>

			</div>
	
</body>
</html>
