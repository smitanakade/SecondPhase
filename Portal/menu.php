<?php
   session_start();
   
include_once("check.php");
?>

<nav class="navbar navbar-inverse" >
<div class="container-fluid" >
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="MyerAdminPortal.php">Home</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" >
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu Management<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="MenuCategory.php">View Menu Group</a></li>
        <li><a href="ViewMainCategory.php">Edit & View Main Group</a></li>
        <li><a href="ViewSubGroup.php">Edit & View Sub Group</a></li>
        <li><a href="ViewThirdGroup.php">Edit & View Third Group</a></li>


        <li role="separator" class="divider"></li>
        <li><a href="AddMainCategories.php">Create Main Group</a></li>
        <li><a href="addSubMainGroup.php">Create Sub Group</a></li>
        <li><a href="thirdLevelCat.php">Create Third Level Group</a></li>
        
        </ul>
      </li>
      <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Academy Portal<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="ViewAcademyLearningMoment.php">View Academy Learning Moment</a></li>
        <li><a href="AddAcademyLM.php">Add Academy Learning Moment</a></li>
        
      </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage People Leader Portal <span class="caret"></span></a>
        <ul class="dropdown-menu">
         <li><a href="ViewPeopleLeaderActivity.php">View People Leader Activity</a></li>
          <li><a href="AddPeopleLeaderActivity.php"> Add  People Leader Activity</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="ViewPeopleLeaderLearningMoment.php"> View People Leader Learning Moment</a></li>
          <li><a href="AddPeopleLeaderLearningMoment.php"> Add People Leader Learning Moment</a></li>
        </ul>
      </li>
      <li class="dropdown" > <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Management<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="ViewUser.php">View & Edit User</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="RegisterUser.php">Register User</a></li>
		<li><a href="ImportUser.php">Import Users From CSV</a></li>
</ul>
    </li>
    
    
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reporting<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="Reports.php"> Myer Academy & People Leader Reports</a></li>
        
        </ul>
      </li>
     
      <a class="navbar-brand" href="Logout.php">LOG OUT</a>

    </ul>
   <!--  <form class="navbar-form navbar-left">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form> -->
   
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>