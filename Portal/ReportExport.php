<?php 
include_once("db_connect.php");

if (isset($_POST))
{
        print_r($_POST);
    $query="";
    $flag="";
    $dateCaluse="";    
    $whereClause=" WHERE ";
    $html="";
//    if(isset($_POST['Site'])){
     
        //HERE Starting assigning Start Date and End Date for query
        $startDate= ($_POST['StartDate'] !="")? $_POST['StartDate'] : NULL;
        $enddate = ($_POST['EndDate']!="")?  $_POST['EndDate'] : 'NOW()';
        $Location = ($_POST['Location'] !="")? $_POST['Location'] : NULL;
        $Department= ($_POST['Department'] !="")? $_POST['Department'] : NULL;
        //ENDING  assigning Start Date and End Date for query
            //genrating Count of Comment Start HERE
            if($_POST['reportname']=='Comments'){
                if($startDate !="undefined"){
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
                    $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,'Leader LM' as Activity FROM LeaderLMComment as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId ";
                    }
                if($_POST['Site']=='academy'){
                        $query="SELECT l.PageTitle as Title,COUNT(c.Comment) as ActivityCNT,'Academy LM' as Activity FROM LMComment as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY l.pageId";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.Comment) as ActivityCNT,'Academy LM' as Activity FROM LMComment as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID  ".$clause." GROUP BY l.pageId UNION ALL SELECT l.Title,COUNT(c.Comment) as ActivityCNT,'Leader LM' as Activity FROM LeaderLMComment as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID  ".$clause." GROUP BY l.pageId";
                }
                $thead="<tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>".$_POST['reportname']." Count</th>
                    <th>Page From</th></tr>
                    ";
                    
                }
                //genrating Count of Comment END HERE

                //genrating Count of LIKE Start HERE
            if($_POST['reportname']=='Like'){
                if($startDate !="undefined"){
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
                    $query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,'Leader LM' as Activity FROM LeaderLMPagelike as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId";
                }
                if($_POST['Site']=='academy'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.pageLike) as ActivityCNT,'Academy LM' as Activity FROM LMPagelike as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId";
                }
                if($_POST['Site']=='all'){
                    $query="SELECT l.PageTitle as Title,COUNT(c.pageLike) as ActivityCNT,'Academy LM' as Activity FROM LMPagelike as c JOIN academyLM as l on l.pageId = c.PageID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId
                    UNION ALL
                    SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,'Leader LM' as Activity FROM LeaderLMPagelike as c JOIN leaderlearningmoment as l on l.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.pageId";
                }
                
                $thead="<tr>
                <th>#</th>
                <th>Title</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Page From</th></tr>
                ";
                
            }
            //genrating Count of LIKE Start END


            if($_POST['reportname']=='ActivityLike'){
                if($startDate !="undefined"){
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
                $query="SELECT l.Title as Title,COUNT(c.pageLike) as ActivityCNT,'Leader Activity' as Activity FROM LeaderActivityPagelike as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY l.ID";
                $thead="<tr>
                <th>#</th>
                <th>Title</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Page From</th></tr>
                ";
                
            }
            
            if($_POST['reportname']=='ActivityComments'){
                if($startDate !="undefined"){
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
                $query="SELECT l.Title as Title,COUNT(c.Comment) as ActivityCNT,'Leader Activity' as Activity FROM LeaderActivityComment as c JOIN leaderassociation as l on l.ID = c.ActivityID JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY l.ID";
                $thead="<tr>
                <th>#</th>
                <th>Title</th>
                <th>".$_POST['reportname']." Count</th>
                <th>Page From</th></tr>
                ";
                
            }
            if($_POST['reportname']=='Commentslike'){
                if($startDate !="undefined"){
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
                    $query="SELECT l.Title as PageTitle,c.Comment as COMMENT, COUNT(CL.CommentLike)  as ActivityCNT,'Leader LM' as Activity FROM LeaderLMComment as c JOIN LeaderLMCommentLike as CL on CL.CommentID = c.ID JOIN leaderlearningmoment as l on l.pageId= c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause." GROUP BY c.ID";
                }
                if($_POST['Site']=='academy'){   
                    $query="SELECT a.PageTitle as PageTitle, c.COMMENT as COMMENT, COUNT(cl.CommentLike) as ActivityCNT,'Academy LM' as Activity FROM LMComment as c Join LMCommentLike as cl on cl.CommentID= c.ID Join academyLM as a on a.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."  GROUP BY c.ID";                 
                }
                if($_POST['Site']=='all'){
                    $query="SELECT a.PageTitle as PageTitle, c.COMMENT as COMMENT, COUNT(cl.CommentLike) as ActivityCNT,'Academy LM' as Activity FROM LMComment as c Join LMCommentLike as cl on cl.CommentID= c.ID Join academyLM as a on a.pageId = c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID ".$clause."   GROUP BY c.ID UNION ALL SELECT l.Title,c.Comment, COUNT(CL.CommentLike) as ActivityCNT,'Leader LM' as Activity FROM LeaderLMComment as c JOIN LeaderLMCommentLike as CL on CL.CommentID = c.ID JOIN leaderlearningmoment as l on l.pageId= c.pageId JOIN userdetails as u on u.EmployeeNo = c.UserID  ".$clause." GROUP BY c.ID";                    
                }     
                $thead="<tr>
                <th>#</th>
                <th>Page Title</th>
                <th>COMMENT</th>                
                <th>".$_POST['reportname']." Count</th>
                <th>Activity</th></tr>
                ";
                               
            }
         if($_POST['reportname']=='Useractivity'){
            if($startDate !="undefined"){
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
                
                 $query="SELECT lm.PageTitle as PageTitle,u.NameReport as Employee,u.Department,u.OccStateCode as State ,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'Acadmey LM' as Activity  From 
                        AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."  ORDER BY lm.PageTitle ASC ";
            }
            if($_POST['Site']=='leader'){                    
                $query="SELECT lm.Title as PageTitle,u.NameReport as Employee,u.Department,u.OccStateCode as State,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'Leader LM' as Activity  From usertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." ORDER BY lm.Title ASC ";
            }
            if($_POST['Site']=='all'){
                $query="SELECT lm.PageTitle as PageTitle,u.NameReport as Employee,u.Department,u.OccStateCode as State ,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'Acadmey LM' as Activity  From AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."
                UNION ALL
                SELECT lm.Title as PageTitle,u.NameReport as Employee,u.Department,u.OccStateCode as State,InTime,OutTime,TIME(TIMEDIFF(OutTime,InTime)) AS duration,Resolution,Browser,onDate,'Leader LM' as Activity  From usertracking as au JOIN userdetails as u on u.EmployeeNo= au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause;
            }    
            $thead="<tr>
            <th>#</th>
            <th>Page Title</th>
            <th>Employee</th>                
            <th>Department</th>
            <th>State</th>
            <th>InTime</th>
            <th>OutTime</th>            
            <th>Duration</th>
            <th>Resolution</th>
            <th>Browser</th>
            <th>onDate</th>
            <th>Activity </th>
            </tr>
            ";            
        }
        if($_POST['reportname']=='pageview'){
            if($startDate !="undefined"){
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
                $query="SELECT lm.PageTitle as PageTitle,lm.MainCategory,lm.SubCategory,lm.ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Academy LM' as Activity FROM AcadmeyUsertracking as au
                JOIN userdetails as u on u.EmployeeNo = au.UserId
                JOIN academyLM as lm on lm.pageId = au.pageId ".$clause."
                Group By lm.pageId";
            }
            if($_POST['Site']=='leader'){   
                $query="SELECT lm.Title as PageTitle,lm.MainCategory,lm.category as SubCategory,' ' as ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Leader LM' as Activity FROM usertracking as au
                JOIN userdetails as u on u.EmployeeNo = au.UserId
                JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause."
                Group By lm.pageId";                 
            }      
            
            if($_POST['Site']=='all'){
                $query="SELECT lm.Title as PageTitle,lm.MainCategory,lm.category as SubCategory,' ' as ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Leader LM' as Activity FROM usertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN leaderlearningmoment as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId 
                UNION ALL 
                SELECT lm.PageTitle as PageTitle,lm.MainCategory,lm.SubCategory,lm.ThirdLevelCategory, InTime,OutTime, TIME(TIMEDIFF(OutTime,InTime)) AS duration, COUNT(au.pageId) as ViewNO,'Academy LM' as Activity FROM AcadmeyUsertracking as au JOIN userdetails as u on u.EmployeeNo = au.UserId JOIN academyLM as lm on lm.pageId = au.pageId ".$clause." Group By lm.pageId";
            }

            $thead="<tr>
            <th>#</th>
            <th>Page Title</th>
            <th>MainCategory</th>                
            <th>SubCategory</th>
            <th>ThirdLevelCategory</th>
            <th>InTime</th>
            <th>OutTime</th>            
            <th>Duration</th>
            <th>ViewNO</th>
            <th>Activity</th>
            </tr>
            ";            
}            
          

           echo $query;
            $result= mysqli_query($link, $query);
            $count = mysqli_num_rows($result);
             

      $html='<div class="row">
            <div class="col-xs-12">
            <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <thead>';
                        if($count > 0){ 
                            $i=1;
                            //echo $thead;
                            $html=$thead;
                            if($_POST['reportname']!='Commentslike' && $_POST['reportname']!='Useractivity'&& $_POST['reportname']!='pageview'){
                                
                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                              $html.="  <tr>
                                <td scope='row'>". $i."</td>
                                <td>". $row["Title"]."</td>
                                <td>".$row["ActivityCNT"]."</td>
                                <td>".$row["Activity"]."</td>
                                </tr>";
                        
                                $i++;
                            }    
                        }   
                        if($_POST['reportname']=='Commentslike'){
                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
                               $html.=" <tr>
                                <td scope='row'>". $i."</td>
                                <td>".["PageTitle"]."</td>
                                <td>". $row["COMMENT"]."</td>
                                <td>". $row["ActivityCNT"]."</td>
                                <td>".$row["Activity"]."</td>

                                </tr>";
                                
                            $i++; }
                        }   
                        if($_POST['reportname']=='Useractivity'){
                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) { 
                                $html.=" <tr>
                                <td>". $i."</td>
                            <td>".$row['PageTitle']."</td>
                            <td>".$row['Employee']."</td>                
                            <td>".$row['Department']."</td>
                            <td>".$row['State']."</td>
                            <td>".$row['InTime']."</td>
                            <td>".$row['OutTime']."</td>
                            <td>".$row['duration']."</td>
                            <td>".$row['Resolution']."</td>
                            <td>".$row['Browser']."</td>
                            <td>".$row['onDate']."</td>
                            <td>".$row["Activity"]."</td>
                            
                            </tr>";

                        $i++; }
                        }
                        if($_POST['reportname']=='pageview'){
                            while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) { 
                            $html.="<tr>
                                <td>".$i."</td>                              
                                <td>".$row['PageTitle']."</td>
                                <td>".$row['MainCategory']."</td>                
                                <td>".$row['SubCategory']."</td>
                                <td>".$row['ThirdLevelCategory']."</td>
                                <td>".$row['InTime']."</td>
                                <td>".$row['OutTime']."</td>            
                                <td>".$row['duration']."</td>
                                <td>".$row['ViewNO']."</td>
                                <td>".$row['Activity']."</td>   
                                </tr>";

                         $i++; }   
                        }
                       
                        
                        }else{
                            $html.="<tr><td colspan='5'><font  style='color:red;font-size:bold;'>No Record Found !! Try with different Filter..</td></tr>";
                           
                        }
                        
                        $html.="  </thead>
                        </table>
                        </div>
                        </div>
                        </div>";    
                        echo $html;
      
            
//}

}

?>