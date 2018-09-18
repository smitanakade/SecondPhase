<?php
include_once("db_connect.php");
if(isset($_POST['export'])){
    $today =date('Y-m-d');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$_POST['reportname'].'-Report-'.$today.'.csv');
    $output = fopen("php://output", "w");

    $query="";
    $flag="";
    $dateCaluse="";
    $whereClause=" WHERE ";
    if(isset($_POST['Site'])){

        //HERE Starting assigning Start Date and End Date for query
        $startDate= ($_POST['StartDate'] !="")? $_POST['StartDate'] : NULL;
        $enddate = ($_POST['EndDate']!="")?  $_POST['EndDate'] : 'NOW()';
        $Location = ($_POST['Location'] !="")? $_POST['Location'] : NULL;
        $Department= ($_POST['Department'] !="")? $_POST['Department'] : NULL;
        //ENDING  assigning Start Date and End Date for query

            //genrating Count of Comment Start HERE
            if($_POST['reportname']=='Comments'){

                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.CommentedON >= '".$startDate."' and c.CommentedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="")? $whereClause:"";
                 if($_POST['Site']=='leader'){
                    $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId Order BY l.Title ASC";
                    }
                if($_POST['Site']=='academy'){
                        $query="SELECT l.PageTitle as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORder BY PageTitle ASC";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId
                    UNION ALL
                    SELECT l.PageTitle as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORder BY Title ASC
                    ";
                }

                    fputcsv($output, array('Title','Comments Count','MainCategory','SubCategory','ThirdLevelCategory','Activity'));

                }
                //genrating Count of Comment END HERE

                //genrating Count of LIKE Start HERE
            if($_POST['reportname']=='Like'){
                if($startDate !=""){
                    $flag="YES";
                //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.likedON >= '".$startDate."' and c.likedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }

                 $clause= ($flag !="")?$whereClause:"";
                if($_POST['Site']=='leader'){
                    $query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMPagelike as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORDER BY  l.Title ASC";
                }
                if($_POST['Site']=='academy'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMPagelike as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORDER BY  l.PageTitle ASC";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMPagelike as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId
                    UNION ALL
                    SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMPagelike as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORDER BY Title ASC";
                }


                fputcsv($output, array('Title','Comments Count','MainCategory','SubCategory','ThirdLevelCategory','Activity'));


            }
            //genrating Count of LIKE Start END


            if($_POST['reportname']=='Activity Like'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.likedON >= '".$startDate."' and c.likedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="")?$whereClause:"";
                //$query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,Category,Filter As ActivityType,'Leader Activity' as Activity FROM LeaderActivityPagelike as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.ID";
                $query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,Category,Filter As ActivityType,'Leader Activity' as Activity FROM LeaderActivityPagelike as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.Title ASC";

                fputcsv($output, array('Title','Like Count','Category','Activity Type','Activity From'));

            }

            if($_POST['reportname']=='Activity Comments'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.CommentedON >= '".$startDate."' and c.CommentedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="")?$whereClause:"";
                $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,Category,Filter As ActivityType,'Leader Activity' as Activity FROM LeaderActivityComment as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY l.ID";

                fputcsv($output, array('Title','Comment Count','Category','Activity Type','Activity From'));


            }
            if($_POST['reportname']=='Comments Like'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.CommentedON >= '".$startDate."' and c.CommentedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                     $whereClause.=($flag !="") ? "AND" : "";
                     $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="") ? $whereClause : "";
                 if($_POST['Site']=='leader'){
                    $query="SELECT l.Title as PageTitle,c.Comment as COMMENT, COUNT(CL.CommentLike)  as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN LeaderLMCommentLike as CL on CL.CommentID = c.ID JOIN leaderlearningmoment as l on l.pageId= c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY c.ID ORDER BY l.Title ASC";
                }
                if($_POST['Site']=='academy'){
                    $query="SELECT a.PageTitle as PageTitle, c.COMMENT as COMMENT, COUNT(cl.CommentLike) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c Join LMCommentLike as cl on cl.CommentID= c.ID Join academyLM as a on a.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY c.ID ORDER BY a.PageTitle ASC";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT a.PageTitle as PageTitle, c.COMMENT as COMMENT, COUNT(cl.CommentLike) as ActivityCNT,a.MainCategory,a.SubCategory,a.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c Join LMCommentLike as cl on cl.CommentID= c.ID Join academyLM as a on a.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."   GROUP BY c.ID UNION ALL SELECT l.Title,c.Comment, COUNT(CL.CommentLike) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN LeaderLMCommentLike as CL on CL.CommentID = c.ID JOIN leaderlearningmoment as l on l.pageId= c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID  ".$clause." GROUP BY c.ID ORDER BY PageTitle ASC";
                }

                fputcsv($output, array('PageTitle','COMMENT','Comments like Count','MainCategory','SubCategory','ThirdLevelCategory','Activity'));

            }
            if($_POST['reportname']=='User Activity'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" onDate >= '".$startDate."' and onDate  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                   $whereClause.="  u.OccStateCode='".$Location."'";
                }
                if($Department !=""){
                   $whereClause.=($flag !="") ? "AND" : "";
                   $flag="YES";
                   $whereClause.="  u.Department='".$Department."'";
                }
                $clause= ($flag !="") ? $whereClause : "";
                 if($_POST['Site']=='academy'){

                     $query="SELECT lm.PageTitle as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State ,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate , 'Academy LM' as Activity From
                            AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."  ORDER BY lm.PageTitle ASC ";
                }
                if($_POST['Site']=='leader'){
                    $query="SELECT lm.Title as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate , 'People Leader Learning Moment ' as Activity From usertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." ORDER BY lm.Title ASC ";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT lm.PageTitle as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State ,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate , 'Academy LM' as Activity From AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."
                    UNION ALL
                    SELECT lm.Title as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate , 'People Leader Learning Moment ' as Activity From usertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause;
                }
                fputcsv($output, array('Page Title','Employee Id','Employee','Department','State','Time In','Time Out','Duration','Resolution','Browser','Date','Activity'));

            }
            if($_POST['reportname']=='Page View'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" onDate >= '".$startDate."' and onDate  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                   $whereClause.="  u.OccStateCode='".$Location."'";
                }
                if($Department !=""){
                   $whereClause.=($flag !="") ? "AND" : "";
                   $flag="YES";
                   $whereClause.="  u.Department='".$Department."'";
                }
                $clause= ($flag !="") ? $whereClause : "";
                if($_POST['Site']=='academy'){
                    $query="SELECT lm.PageTitle as PageTitle,lm.MainCategory,lm.SubCategory,lm.ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Academy Learning Moment ' as Activity FROM AcadmeyUsertracking as au
                    JOIN userdetails as u on u.EmployeeNo = au.UserId
                    JOIN academyLM as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId";
                }
                if($_POST['Site']=='leader'){
                    $query="SELECT lm.Title as PageTitle,lm.MainCategory,lm.category as SubCategory,' ' as ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'People Leader Learning Moment ' as Activity FROM usertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId";
                }

                if($_POST['Site']=='all'){
                    $query="SELECT lm.Title as PageTitle,lm.MainCategory,lm.category as SubCategory,' ' as ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'People Leader Learning Moment ' as Activity FROM usertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId
                    UNION ALL
                    SELECT lm.PageTitle as PageTitle,lm.MainCategory,lm.SubCategory,lm.ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Academy Learning Moment ' as Activity FROM AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId";
                }
                fputcsv($output, array('Page Title','Main Category','Sub Category','ThirdLevelCategory','Time In','Time Out','Duration','Views Count','Activity'));

            }

            $result= mysqli_query($link, $query);
            $count = mysqli_num_rows($result);

                        if($count > 0){
                                    while ($row =  mysqli_fetch_assoc($result)) {
                                    fputcsv($output, $row);
                            }
                            fclose($output);
                            exit;
                        }
}
}
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
<style>
.no-spin::-webkit-inner-spin-button {
    -webkit-appearance: none;
  }

</style>
<script>
$(document).ready(function () {

    $("#clearsearch").click(function () {
                        var full_url = document.URL;
                        event.preventDefault();
                        event.stopPropagation();
                        window.location.href = full_url;
                    });
            });

</script>
</head>
<body>
    <?php require_once("menu.php");?>
    <br />
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data"   name="RegForm" id="RegForm">
    <div class="container">
            <div class="row main">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h2 class="title">Myer Academy & People Leader Reports</h2>
                        <hr />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="reporttype" class="col-sm-2">Report Type</label>
                <div class="col-sm-6">
                    <select id="reportname" name="reportname" class="form-control" required>
                        <option value="">Select report type</option>
                        <option value="Activity Like" <?php $selected= ($_POST['reportname']=="Activity Like")? "selected" :''; echo $selected?>>Activity  Like Report</option>
						    <option value="Activity Comments" <?php $selected= ($_POST['reportname']=="Activity Comments")? "selected" :''; echo $selected?>>Activity Comments Report</option>
                            <option value="Comments" <?php $selected= ($_POST['reportname']=="Comments")? "selected" :''; echo $selected?>>Learning Moments Comments Report</option>
						  <option value="Comments Like" <?php $selected= ($_POST['reportname']=="Comments Like")? "selected" :''; echo $selected?>>Learning Moments Comments Like Report</option>
                        <option value="Like" <?php $selected= ($_POST['reportname']=="Like")? "selected" :''; echo $selected?>>Learning Moments Like Report</option>
                       						 <option value="Page View" <?php $selected= ($_POST['reportname']=="Page View")? "selected" :''; echo $selected?>>Learning Moments Page View Report</option>
                                                <option value="User Activity" <?php $selected= ($_POST['reportname']=="User Activity")? "selected" :''; echo $selected?>>User Activity Report</option>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="startdate" class="col-sm-2">Start date</label>
                <div class="col-sm-2">
                    <input id="startdate" type="date" name="StartDate" id="datepicker" class="no-spin">
                </div>
                <label for="enddate" class="col-sm-2 text-right">End date</label>
                <div class="col-sm-2 ">
                    <input id="EndDate" type="date" name="EndDate" id="datepicker" class="no-spin">
                </div>
            </div>
            <div class="form-group row">
                <label for="location" class="col-sm-2">Location</label>
                <div class="col-sm-6">
                    <select id="Location" name="Location" class="form-control">
                        <option value="">Select location</option>
                        <option value="ACT" <?php $selected= ($_POST['Location']=="ACT")? "selected" :''; echo $selected?>>ACT</option>
                        <option value="NSW" <?php $selected= ($_POST['Location']=="NSW")? "selected" :''; echo $selected?>>NSW</option>
                        <option value="NT" <?php $selected= ($_POST['Location']=="NT")? "selected" :''; echo $selected?>>NT</option>
                        <option value="QLD" <?php $selected= ($_POST['Location']=="QLD")? "selected" :''; echo $selected?>>QLD</option>
                        <option value="SA" <?php $selected= ($_POST['Location']=="SA")? "selected" :''; echo $selected?>>SA</option>
                        <option value="TAS" <?php $selected= ($_POST['Location']=="TAS")? "selected" :''; echo $selected?>>TAS</option>
                        <option value="VIC"<?php $selected= ($_POST['Location']=="VIC")? "selected" :''; echo $selected?>>VIC</option>
                        <option value="WA" <?php $selected= ($_POST['Location']=="WA")? "selected" :''; echo $selected?>>WA</option>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="department" class="col-sm-2">Department</label>
                <div class="col-sm-6">
                    <select id="Department" name="Department" class="form-control">
                        <option value="">Select department</option>
                        <?php

                        $sql = mysqli_query($link, "SELECT distinct(department) FROM userdetails ORDER BY department ASC");
                        while ($row = $sql->fetch_assoc()){
                            $selected= ($_POST['Department']!='')? 'selected':"";
                        echo "<option value='".$row['department']."'".$selected.">" . $row['department'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
			     <div class="form-group row">
                <label for="Site" class="col-sm-2">Site</label>
                <div class="col-sm-6">
                    <select id="Site" name="Site" class="form-control">
					<option value="all" <?php $selected= ($_POST['Site']=="all")? "selected" :''; echo $selected?>>All</option>
                    <option value="academy" <?php $selected= ($_POST['Site']=="academy")? "selected" :''; echo $selected?>>Myer Academy</option>
                    <option value="leader" <?php $selected= ($_POST['Site']=="leader")? "selected" :''; echo $selected?>>People Leader Portal</option>
                    </select>
                </div>
            </div>
			   <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <table width="80%">
          <tr>
            <td>
              <input type="submit" class="btn btn-primary" name="clearsearch" Id="clearsearch" value="CLEAR SEARCH" align="left">
            </td>
            <td align="right">
	             <input type="submit" name="export" id="export" value="EXPORT TO CSV" class="btn btn-success" align="right"/>
               <input type="submit" class="btn btn-primary" name="Submit" Id="Submit" value="SUBMIT" align="right">
             </td>
           </tr>
         </table>

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
<?php
if(isset($_POST['Submit'])){
    $query="";
    $flag="";
    $dateCaluse="";
    $whereClause=" WHERE ";
    if(isset($_POST['Site'])){

        //HERE Starting assigning Start Date and End Date for query
        $startDate= ($_POST['StartDate'] !="")? $_POST['StartDate'] : NULL;
        $enddate = ($_POST['EndDate']!="")?  $_POST['EndDate'] : 'NOW()';
        $Location = ($_POST['Location'] !="")? $_POST['Location'] : NULL;
        $Department= ($_POST['Department'] !="")? $_POST['Department'] : NULL;
        //ENDING  assigning Start Date and End Date for query

            //genrating Count of Comment Start HERE
            if($_POST['reportname']=='Comments'){

                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.CommentedON >= '".$startDate."' and c.CommentedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="")? $whereClause:"";
                 if($_POST['Site']=='leader'){
                    $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId Order BY l.Title ASC";
                    }
                if($_POST['Site']=='academy'){
                        $query="SELECT l.PageTitle as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORder BY PageTitle ASC";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId
                    UNION ALL
                    SELECT l.PageTitle as Title,COUNT(c.Comment) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORder BY Title ASC
                    ";
                }
                $thead="<tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>".$_POST['reportname']." Count</th>
                    <th>Main Category</th>
                    <th>Sub Category</th>
                    <th>Third Category</th>
                   <th>Learning Moment From</th></tr>
                    ";

                }
                //genrating Count of Comment END HERE

                //genrating Count of LIKE Start HERE
            if($_POST['reportname']=='Like'){
                if($startDate !=""){
                    $flag="YES";
                //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.likedON >= '".$startDate."' and c.likedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }

                 $clause= ($flag !="")?$whereClause:"";
                 if($_POST['Site']=='leader'){
                    $query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMPagelike as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORDER BY l.Title ASC";
                }
                if($_POST['Site']=='academy'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMPagelike as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORDER BY l.PageTitle ASC";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMPagelike as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId
                    UNION ALL
                    SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMPagelike as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ORDER BY Title ASC";
                }


                $thead="<tr>
                <th>#</th>
                <th>Title</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Main Category</th>
                <th>Sub Category</th>
                <th>Third Category</th>
               <th>Learning Moment From</th></tr>
                ";

            }
            //genrating Count of LIKE Start END


            if($_POST['reportname']=='Activity Like'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.likedON >= '".$startDate."' and c.likedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="")?$whereClause:"";
                $query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,Category,Filter As ActivityType,'Leader Activity' as Activity FROM LeaderActivityPagelike as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.Title ASC";
                $thead="<tr>
                <th>#</th>
                <th>Title</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Category</th>
                <th>Activity Type</th>
                <th>Activity From</th></tr>
                ";

            }

            if($_POST['reportname']=='Activity Comments'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.CommentedON >= '".$startDate."' and c.CommentedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="")?$whereClause:"";
                $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,Category,Filter As ActivityType,'Leader Activity' as Activity FROM LeaderActivityComment as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY l.Title ASC";
                $thead="<tr>
                <th>#</th>
                <th>Title</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Category</th>
                <th>Activity Type</th>
                <th>Activity From</th></tr>
                ";

            }
            if($_POST['reportname']=='Comments Like'){
                if($startDate !=""){
                    $flag="YES";
                    //IF StartDate is present creating Where caluse for this condition query
                    $whereClause.=" c.CommentedON >= '".$startDate."' and c.CommentedON  <= '".$enddate."' ";
                 }
                 if($Location !=""){
                     $whereClause.=($flag !="") ? "AND" : "";
                     $flag="YES";
                    $whereClause.="  u.OccStateCode='".$Location."'";
                 }
                 if($Department !=""){
                    $whereClause.=($flag !="") ? "AND" : "";
                    $flag="YES";
                    $whereClause.="  u.Department='".$Department."'";
                 }
                 $clause= ($flag !="") ? $whereClause : "";
                 if($_POST['Site']=='leader'){
                    $query="SELECT l.Title as PageTitle,c.Comment as COMMENT, COUNT(CL.CommentLike)  as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN LeaderLMCommentLike as CL on CL.CommentID = c.ID JOIN leaderlearningmoment as l on l.pageId= c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY c.ID ORDER BY l.Title ASC";
                }
                if($_POST['Site']=='academy'){
                    $query="SELECT a.PageTitle as PageTitle, c.COMMENT as COMMENT, COUNT(cl.CommentLike) as ActivityCNT,l.MainCategory,l.SubCategory,l.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c Join LMCommentLike as cl on cl.CommentID= c.ID Join academyLM as a on a.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY c.ID ORDER BY a.PageTitle ASC";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT a.PageTitle as PageTitle, c.COMMENT as COMMENT, COUNT(cl.CommentLike) as ActivityCNT,a.MainCategory,a.SubCategory,a.ThirdLevelCategory,'Academy Learning Moment ' as Activity FROM LMComment as c Join LMCommentLike as cl on cl.CommentID= c.ID Join academyLM as a on a.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."   GROUP BY c.ID UNION ALL SELECT l.Title,c.Comment, COUNT(CL.CommentLike) as ActivityCNT,l.MainCategory,l.category as SubCategory,'' as ThirdLevelCategory,'People Leader Learning Moment ' as Activity FROM LeaderLMComment as c JOIN LeaderLMCommentLike as CL on CL.CommentID = c.ID JOIN leaderlearningmoment as l on l.pageId= c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID  ".$clause." GROUP BY c.ID ORDER BY PageTitle ASC";
                }
                $thead="<tr>
                <th>#</th>
                <th>Page Title</th>
                <th>Comment</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Main Category</th>
                <th>Sub Category</th>
                <th>Third Category</th>
               <th>Learning Moment From</th></tr>
                ";

            }
         if($_POST['reportname']=='User Activity'){
            if($startDate !=""){
                $flag="YES";
                //IF StartDate is present creating Where caluse for this condition query
                $whereClause.=" onDate >= '".$startDate."' and onDate  <= '".$enddate."' ";
             }
             if($Location !=""){
                $whereClause.=($flag !="") ? "AND" : "";
                $flag="YES";
               $whereClause.="  u.OccStateCode='".$Location."'";
            }
            if($Department !=""){
               $whereClause.=($flag !="") ? "AND" : "";
               $flag="YES";
               $whereClause.="  u.Department='".$Department."'";
            }
            $clause= ($flag !="") ? $whereClause : "";
             if($_POST['Site']=='academy'){

                 $query="SELECT lm.PageTitle as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State ,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'Academy LM' as Activity  From
                        AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."  ORDER BY lm.PageTitle ASC ";
            }
            if($_POST['Site']=='leader'){
                $query="SELECT lm.Title as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'People Leader Learning Moment ' as Activity  From usertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." ORDER BY lm.Title ASC ";
            }
            if($_POST['Site']=='all'){
                $query="SELECT lm.PageTitle as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State ,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'Academy LM' as Activity  From AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."
                UNION ALL
                SELECT lm.Title as PageTitle,u.EmployeeNo as EmployeeId,u.NameReport as Employee,u.Department,u.OccStateCode as State,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'People Leader Learning Moment ' as Activity  From usertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause;
            }

            $thead="<tr>
            <th>#</th>
            <th>Page Title</th>
            <th>Team Member ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>State</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Duration</th>
            <th>Resolution</th>
            <th>Browser</th>
            <th>Date</th>
           <th>Learning Moment From </th>
            </tr>
            ";
        }
        if($_POST['reportname']=='Page View'){
            if($startDate !=""){
                $flag="YES";
                //IF StartDate is present creating Where caluse for this condition query
                $whereClause.=" onDate >= '".$startDate."' and onDate  <= '".$enddate."' ";
             }
             if($Location !=""){
                $whereClause.=($flag !="") ? "AND" : "";
                $flag="YES";
               $whereClause.="  u.OccStateCode='".$Location."'";
            }
            if($Department !=""){
               $whereClause.=($flag !="") ? "AND" : "";
               $flag="YES";
               $whereClause.="  u.Department='".$Department."'";
            }
            $clause= ($flag !="") ? $whereClause : "";
            if($_POST['Site']=='academy'){
                $query="SELECT lm.PageTitle as PageTitle,lm.MainCategory,lm.SubCategory,lm.ThirdLevelCategory, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Academy Learning Moment ' as Activity FROM AcadmeyUsertracking as au
                JOIN userdetails as u on u.EmployeeNo = au.UserId
                JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."
                Group By lm.pageId";
            }
            if($_POST['Site']=='leader'){
                $query="SELECT lm.Title as PageTitle,lm.MainCategory,lm.category as SubCategory,' ' as ThirdLevelCategory, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'People Leader Learning Moment ' as Activity FROM usertracking as au
                JOIN userdetails as u on u.EmployeeNo = au.UserId
                JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause."
                Group By lm.pageId";
            }

            if($_POST['Site']=='all'){
                $query="SELECT lm.Title as PageTitle,lm.MainCategory,lm.category as SubCategory,' ' as ThirdLevelCategory, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'People Leader Learning Moment ' as Activity FROM usertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId
                UNION ALL
                SELECT lm.PageTitle as PageTitle,lm.MainCategory,lm.SubCategory,lm.ThirdLevelCategory, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Academy Learning Moment ' as Activity FROM AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId";
            }

            $thead="<tr>
            <th>#</th>
            <th>Page Title</th>
            <th>Main Category</th>
            <th>Sub Category</th>
            <th>Third Category</th>
            <th>Duration</th>
            <th>Views Count</th>
           <th>Learning Moment From</th>
            </tr>
            ";
}


           //echo $query;
            $result= mysqli_query($link, $query);
            $count = mysqli_num_rows($result);

?>
        <div class="row"style="margin:30px;">
            <div class="col-xs-12">
            <div class="table-responsive">
            <?php echo "<h1>Review ".$_POST['reportname']." Report- Showing Total Result :".$count."</h1>"?>

                        <table class="table table-bordered table-hover">
                        <thead>

                        <?php
                        if($count > 0){
                            $i=1;
                            echo $thead;
                            if($_POST['reportname']=='Activity Like' || $_POST['reportname']=='Activity Comments'){

                                while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {?>
                                    <tr>
                                    <td scope="row"><?php echo $i; ?></td>
                                    <td><?php echo $row["Title"];?></td>
                                    <td><?php echo $row["ActivityCNT"]; ?></td>
                                    <td><?php echo $row["Category"]; ?></td>
                                    <td><?php echo $row["ActivityType"]; ?></td>
                                    <td><?php echo $row["Activity"]; ?></td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            if($_POST['reportname']=='Like' || $_POST['reportname']=='Comments'){

                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {?>
                                <tr>
                                <td scope="row"><?php echo $i; ?></td>
                                <td><?php echo $row["Title"];?></td>
                                <td><?php echo $row["ActivityCNT"]; ?></td>
                                <td><?php echo $row["MainCategory"]; ?></th>
                                <td><?php echo $row["SubCategory"]; ?></th>
                                <td><?php echo $row["ThirdLevelCategory"]; ?></th>
                                <td><?php echo $row["Activity"];?></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        if($_POST['reportname']=='Comments Like'){

                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {?>
                                <tr>
                                <td scope="row"><?php echo $i; ?></td>
                                <td><?php echo $row["PageTitle"];?></td>
                                <td><?php echo $row["COMMENT"]; ?></td>
                                <td><?php echo $row["ActivityCNT"];?></td>
                                <td><?php echo $row["MainCategory"]; ?></th>
                                <td><?php echo $row["SubCategory"]; ?></th>
                                <td><?php echo $row["ThirdLevelCategory"]; ?></th>
                                <td><?php echo $row["Activity"];?></td>

                                </tr>

                            <?php $i++; }
                        }
                        if($_POST['reportname']=='User Activity'){
                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) { ?>
                                <tr>
                                <td><?php echo $i;?></td>
                            <td><?php echo $row['PageTitle'];?></td>
                            <td><?php echo $row['EmployeeId'];?></td>
                            <td><?php echo $row['Employee'];?></td>
                            <td><?php echo $row['Department'];?></td>
                            <td><?php echo $row['State'];?></td>
                            <td><?php echo $row['InTime'];?></td>
                            <td><?php echo $row['OutTime'];?></td>
                            <td><?php echo $row['duration'];?></td>
                            <td><?php echo $row['Resolution'];?></td>
                            <td><?php echo $row['Browser'];?></td>
                            <td><?php echo $row['onDate'];?></td>
                            <td><?php echo $row["Activity"];?></td>

                            </tr>

                        <?php $i++; }
                        }
                        if($_POST['reportname']=='Page View'){
                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) { ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['PageTitle'];?></td>
                                <td><?php echo $row['MainCategory'];?></td>
                                <td><?php echo $row['SubCategory'];?></td>
                                <td><?php echo $row['ThirdLevelCategory'];?></td>
                                <td><?php echo $row['duration'];?></td>
                                <td><?php echo $row['ViewNO'];?></td>
                                <td><?php echo $row['Activity'];?></td>
                                </tr>

                        <?php $i++; }
                        }
                        }else{
                            echo "<tr><td colspan='5'><font  style='color:red;font-size:bold;'>No records were found. If you have applied filters, please try adjusting</td></tr>";
                        }
                        ?>
                        </thead>
                        </table>
                        </div>
                        </div>
                        </div>
        <?php

}

}
?>
