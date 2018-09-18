<?php       
include_once ("db_connect.php");
 if(isset($_POST)){

 //Start-For site All
 if($_POST['Site']=='all'){
 if($_POST['ReportType']=='like'){
 //Query 1
	 $sql1="(SELECT pl.`PageID`,la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql1);

 $sql1="(SELECT pl.`PageID`,la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and  ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql1 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql1);

  $sql1="(SELECT pl.`PageID`,la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId  
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql1 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". date('Y-m-d')."')";
}
}


 $sql1 .= "group by pl.`PageID`)";
  //Query 2
  $sql2="(SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId 
	 WHERE pl.`pageLike`='like'";
	 	 if($_POST['Location']!=''){
unset($sql2);

 $sql2="(SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId  
      inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql2 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql2);

  $sql2="(SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId  
      inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql2 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". date('Y-m-d')."')";
}
}

	// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
// $sql2 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}
	  $sql2 .= "group by pl.`PageID`)";

	  //Join query 1 and query 2

	  $sql=$sql1." UNION ALL" .$sql2;
	  
}else if($_POST['ReportType']=='comments'){

			 $sql1="(SELECT ac.PageID,la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(ac.`Comment`) as Comments 
			 FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql1);

 $sql1="(SELECT ac.PageID,la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(ac.`Comment`) as Comments 
 FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
 inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql1 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql1="(SELECT ac.PageID,la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(ac.`Comment`) as Comments 
  FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
 inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}

if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql1 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". date('Y-m-d')."')";
}
}
 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
// $sql1 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}
 
 $sql1 .= "group by ac.`PageID`)";

  $sql2="(SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as Comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId  
	WHERE pl.`Comment`!=''";
	if($_POST['Location']!=''){
unset($sql2);

 $sql2="(SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as Comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId 
       inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	WHERE pl.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql2 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql2);
  $sql2="(SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as Comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId 
       inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	WHERE pl.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql2.= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". date('Y-m-d')."')";
}
}

	// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql2 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

	  $sql2 .= "group by pl.`PageID`)";

	  $sql=$sql1.' UNION ALL '.$sql2;

}
else if($_POST['ReportType']=='commentslike'){
 $sql1="(SELECT llm.Title as PageTitle,llm.Category,'' as subcategory,'' as thirdcategory,count(lcl.`CommentID`) as NoofCommentslike 
 FROM `LeaderLMCommentLike` lcl inner join LeaderLMComment lc
on lcl.`CommentID`=lc.ID
inner join leaderlearningmoment llm on lc.PageID=llm.pageId
where `CommentLike`='like' ";
if($_POST['Location']!=''){
unset($sql1);
 $sql1="(SELECT llm.Title as PageTitle,llm.Category,'' as subcategory,'' as thirdcategory,count(lcl.`CommentID`) as NoofCommentslike 
 FROM `LeaderLMCommentLike` lcl inner join LeaderLMComment lc
on lcl.`CommentID`=lc.ID
inner join leaderlearningmoment llm on lc.PageID=llm.pageId
 inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like'  and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql1 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql1);
  $sql1="(SELECT llm.Title as PageTitle,llm.Category,'' as subcategory,'' as thirdcategory,count(lcl.`CommentID`) as NoofCommentslike 
  FROM `LeaderLMCommentLike` lcl inner join LeaderLMComment lc
on lcl.`CommentID`=lc.ID
inner join leaderlearningmoment llm on lc.PageID=llm.pageId
 inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql1 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". date('Y-m-d')."')";
}
}

// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql1 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
 //}
 $sql1 .= "GROUP by lcl.`CommentID`)";

 $sql2="(SELECT pa.PageTitle,
(select CategorieDescription from maincategories where id=pa.MainCatId) as Category,
(select smDescription from subMainCategory where smId=pa.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=pa.thLid) as thirdcategory ,
count(lcl.`CommentID`) as NoofCommentslike FROM `LMCommentLike` lcl inner join LMComment  lc
on lcl.`CommentID`=lc.ID
inner join pageassociate pa on lc.PageID=pa.pageId
where `CommentLike`='like'";

if($_POST['Location']!=''){
unset($sql2);
$sql2="(SELECT pa.PageTitle,
(select CategorieDescription from maincategories where id=pa.MainCatId) as Category,
(select smDescription from subMainCategory where smId=pa.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=pa.thLid) as thirdcategory ,
count(lcl.`CommentID`) as NoofCommentslike FROM `LMCommentLike` lcl inner join LMComment  lc
on lcl.`CommentID`=lc.ID
inner join pageassociate pa on lc.PageID=pa.pageId
    inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql2 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql2);
  $sql2="(SELECT pa.PageTitle,
(select CategorieDescription from maincategories where id=pa.MainCatId) as Category,
(select smDescription from subMainCategory where smId=pa.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=pa.thLid) as thirdcategory ,
count(lcl.`CommentID`) as NoofCommentslike FROM `LMCommentLike` lcl inner join LMComment  lc
on lcl.`CommentID`=lc.ID
inner join pageassociate pa on lc.PageID=pa.pageId
    inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like'  and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql2 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". date('Y-m-d')."')";
}
}
 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql2 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
// }
$sql2.="GROUP by lcl.`CommentID`)";

  $sql=$sql1.' UNION ALL '.$sql2;


}
else if($_POST['ReportType']=='pageview'){
 $sql1="(SELECT aa.`PageId` as pageId,alm.Title as PageTitle,alm.Category,'' as subcategory,'' as thirdcategory, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId where 1=1 ";

			 if($_POST['Location']!=''){
unset($sql1);

 $sql1="(SELECT aa.`PageId` as pageId,alm.Title,alm.Category,'' as subcategory,'' as thirdcategory, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId 
                inner join userdetails ud on aa.UserId=ud.EmployeeNo
             where 1=1 and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql1 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql1);
  $sql1="(SELECT aa.`PageId` as pageId,alm.Title,alm.Category,'' as subcategory,'' as thirdcategory, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId 
                inner join userdetails ud on aa.UserId=ud.EmployeeNo
             where 1=1 and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }
 }
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql2 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". date('Y-m-d')."')";
}
}
//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql1 .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}

			  $sql1 .= "group by aa.PageId)";


			  $sql2="(SELECT pl.pageId,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
 where 1=1 ";

  if($_POST['Location']!=''){
unset($sql2);

 $sql2="(SELECT pl.pageId,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
	  inner join userdetails ud on pl.UserId=ud.EmployeeNo
 where 1=1 and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql2 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql2);
  $sql2="(SELECT pl.pageId,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
	  inner join userdetails ud on pl.UserId=ud.EmployeeNo
 where 1=1 and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }
 }

 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql2 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". date('Y-m-d')."')";
}
}

// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql2 .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}
	  $sql2.= "group by pl.pageId)";
	  $sql=$sql1.' UNION ALL '.$sql2;
}
else if($_POST['ReportType']=='useractivity'){
 $sql1="(SELECT ut.UserId as EmployeeId,userdetails.NameReport,
userdetails.OccStateCode as location,
ut.onDate as ViewedDate,
 DATE_FORMAT(ut.InTime,'%H:%i:%s') InTime,
  DATE_FORMAT(ut.OutTime,'%H:%i:%s') OutTime,
    CAST(ut.OutTime-ut.InTime AS TIME) as Duration,
userdetails.Department,
llm.Title as PageViewed
FROM usertracking ut
INNER JOIN userdetails ON ut.UserId=userdetails.EmployeeNo
inner join leaderlearningmoment llm on llm.pageId=ut.pageId where 1=1 ";
if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 $sql1 .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
}
if($_POST['Location']!=''){
$sql1 .= "and userdetails.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
}

if($_POST['Department']!=''){

  $sql1 .= "and userdetails.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
  }
  $sql1.=")";

  //Query 2
   $sql2="(SELECT ut.UserId as EmployeeId,userdetails.NameReport,
userdetails.OccStateCode as location,
ut.onDate as ViewedDate,
 DATE_FORMAT(ut.InTime,'%H:%i:%s') InTime,
  DATE_FORMAT(ut.OutTime,'%H:%i:%s') OutTime,
  '' as Duration,
userdetails.Department,
llm.PageTitle as PageViewed
FROM AcadmeyUsertracking ut
INNER JOIN userdetails ON ut.UserId=userdetails.EmployeeNo
inner join pageassociate llm on llm.pageId=ut.pageId where 1=1 ";
if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 $sql2 .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
}
if($_POST['Location']!=''){
$sql2 .= "and userdetails.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
}

if($_POST['Department']!=''){

  $sql2 .= "and userdetails.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
  }
  $sql2.=")";
  $sql=$sql1.' UNION ALL '.$sql2;

} else if($_POST['ReportType']=='articlepagelike'){
	 $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike 
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". date('Y-m-d')."')";
}
}

//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
// $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}
 $sql .= "group by pl.`ActivityID`";
} 

else if($_POST['ReportType']=='articlecomments'){

			 $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql .= "group by ac.`ActivityID`";
}

 }
  //End-For site All

//For site leader
else  if($_POST['Site']=='leader'){

//For page like report
 if($_POST['ReportType']=='like'){
	 $sql="SELECT pl.`PageID`,la.Title,la.Category,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.`PageID`,la.Title,la.Category,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and  ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT pl.`PageID`,la.Title,la.Category,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". date('Y-m-d')."')";
}
}


//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}


 $sql .= "group by pl.`PageID`";
} 
else if($_POST['ReportType']=='comments'){

			 $sql="SELECT ac.PageID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT ac.PageID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
 inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT ac.PageID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
 inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql .= "group by ac.`PageID`";
}
else if($_POST['ReportType']=='commentslike'){
 $sql="SELECT llm.Title,llm.Category,count(lcl.`CommentID`) as NoofCommentslike FROM `LeaderLMCommentLike` lcl inner join LeaderLMComment lc
on lcl.`CommentID`=lc.ID
inner join leaderlearningmoment llm on lc.PageID=llm.pageId
where `CommentLike`='like' ";
if($_POST['Location']!=''){
unset($sql);
 $sql="SELECT llm.Title,llm.Category,count(lcl.`CommentID`) as NoofCommentslike FROM `LeaderLMCommentLike` lcl inner join LeaderLMComment lc
on lcl.`CommentID`=lc.ID
inner join leaderlearningmoment llm on lc.PageID=llm.pageId
 inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like'  and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT llm.Title,llm.Category,count(lcl.`CommentID`) as NoofCommentslike FROM `LeaderLMCommentLike` lcl inner join LeaderLMComment lc
on lcl.`CommentID`=lc.ID
inner join leaderlearningmoment llm on lc.PageID=llm.pageId
 inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
 //}
 $sql .= "GROUP by lcl.`CommentID`";
}
//Start-page view report-leader
else if($_POST['ReportType']=='pageview'){
 $sql="SELECT aa.`PageId`,alm.Title,alm.Category, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId where 1=1 ";

			 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT aa.`PageId`,alm.Title,alm.Category, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId 
                inner join userdetails ud on aa.UserId=ud.EmployeeNo
             where 1=1 and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT aa.`PageId`,alm.Title,alm.Category, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId 
                inner join userdetails ud on aa.UserId=ud.EmployeeNo
             where 1=1 and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }
 }
  if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". date('Y-m-d')."')";
}
}


//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}

			  $sql .= "group by aa.PageId";
}
//end - page view report-leader
//Start-User tracking report-leader
else if($_POST['ReportType']=='useractivity'){
 $sql="SELECT ut.UserId as EmployeeId,userdetails.NameReport,
userdetails.OccStateCode as location,
ut.onDate as ViewedDate,
 DATE_FORMAT(ut.InTime,'%H:%i:%s') InTime,
  DATE_FORMAT(ut.OutTime,'%H:%i:%s') OutTime,
    CAST(ut.OutTime-ut.InTime AS TIME) as Duration,
userdetails.Department,
llm.Title as PageViewed
FROM usertracking ut
INNER JOIN userdetails ON ut.UserId=userdetails.EmployeeNo
inner join leaderlearningmoment llm on llm.pageId=ut.pageId where 1=1 ";
  if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". date('Y-m-d')."')";
}
}

//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}
if($_POST['Location']!=''){
$sql .= "and userdetails.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
}

if($_POST['Department']!=''){

  $sql .= "and userdetails.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
}
}
else if($_POST['ReportType']=='articlepagelike'){
	 $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike 
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
  if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". date('Y-m-d')."')";
}
}

//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}
 $sql .= "group by pl.`ActivityID`";
} 

else if($_POST['ReportType']=='articlecomments'){

			 $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
  if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql .= "group by ac.`ActivityID`";
}
//end - User tracking report-leader

}
// for academy
else  if($_POST['Site']=='academy'){
 if($_POST['ReportType']=='like'){
	 $sql="SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId
	 WHERE pl.`pageLike`='like'";
	 	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId 
      inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId 
      inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql.= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". date('Y-m-d')."')";
}
}

	  $sql .= "group by pl.`PageID`";
	
}

else  if($_POST['ReportType']=='comments'){
	 $sql="SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId 
	WHERE pl.`Comment`!=''";
	if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId 
       inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	WHERE pl.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT pl.`PageID`,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId 
       inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	WHERE pl.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
  if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". date('Y-m-d')."')";
}
}
	// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

	  $sql .= "group by pl.`PageID`";
}
else if($_POST['ReportType']=='commentslike'){
$sql="SELECT pa.PageTitle,
(select CategorieDescription from maincategories where id=pa.MainCatId) as maincategory,
(select smDescription from subMainCategory where smId=pa.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=pa.thLid) as thirdcategory ,
count(lcl.`CommentID`) as NoofCommentslike FROM `LMCommentLike` lcl inner join LMComment lc
on lcl.`CommentID`=lc.ID
inner join pageassociate pa on lc.PageID=pa.pageId
where `CommentLike`='like'";

if($_POST['Location']!=''){
unset($sql);
$sql="SELECT pa.PageTitle,
(select CategorieDescription from maincategories where id=pa.MainCatId) as maincategory,
(select smDescription from subMainCategory where smId=pa.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=pa.thLid) as thirdcategory ,
count(lcl.`CommentID`) as NoofCommentslike FROM `LMCommentLike` lcl inner join LMComment lc
on lcl.`CommentID`=lc.ID
inner join pageassociate pa on lc.PageID=pa.pageId
    inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
}
if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT pa.PageTitle,
(select CategorieDescription from maincategories where id=pa.MainCatId) as maincategory,
(select smDescription from subMainCategory  where smId=pa.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=pa.thLid) as thirdcategory ,
count(lcl.`CommentID`) as NoofCommentslike FROM `LMCommentLike` lcl inner join LMComment lc
on lcl.`CommentID`=lc.ID
inner join pageassociate pa on lc.PageID=pa.pageId
    inner join userdetails ud on lc.`UserID`=ud.EmployeeNo
where `CommentLike`='like'  and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
  if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
 //}
$sql.="GROUP by lcl.`CommentID`";
}

else if($_POST['ReportType']=='pageview'){

 $sql="SELECT pl.pageId,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
 where 1=1 ";

  if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.pageId,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
	  inner join userdetails ud on pl.UserId=ud.EmployeeNo
 where 1=1 and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT pl.pageId,la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
	  inner join userdetails ud on pl.UserId=ud.EmployeeNo
 where 1=1 and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }
 }
   if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". date('Y-m-d')."')";
}
}


 if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 $sql .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
}
	  $sql .= "group by pl.pageId";
			 }else if($_POST['ReportType']=='useractivity'){
 $sql="SELECT ut.UserId as EmployeeId,userdetails.NameReport,
userdetails.OccStateCode as location,
ut.onDate as ViewedDate,
 DATE_FORMAT(ut.InTime,'%H:%i:%s') InTime,
  DATE_FORMAT(ut.OutTime,'%H:%i:%s') OutTime,
userdetails.Department,
llm.PageTitle as PageViewed
FROM AcadmeyUsertracking ut
INNER JOIN userdetails ON ut.UserId=userdetails.EmployeeNo
inner join pageassociate llm on llm.pageId=ut.pageId where 1=1 ";
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". date('Y-m-d')."')";
}
}


//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}
if($_POST['Location']!=''){
$sql .= "and userdetails.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
}

if($_POST['Department']!=''){

  $sql .= "and userdetails.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
}
}
if($_POST['ReportType']=='articlepagelike'){
	 $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike 
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT pl.`ActivityID`,la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". date('Y-m-d')."')";
}
}

//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}
 $sql .= "group by pl.`ActivityID`";
} 

else if($_POST['ReportType']=='articlecomments'){
	 $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT ac.ActivityID,la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". date('Y-m-d')."')";
}
}
// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql .= "group by ac.`ActivityID`";
}
}


if(isset($sql)){
  $res= mysqli_query($link, $sql) or die(mysql_error());
  $count = mysqli_num_rows($res);
  }else{
   $count=0;
  }
  if($count>0){
  
   while($row = mysqli_fetch_array($res)){
    if($_POST['Site']=='all'){
	if($_POST['ReportType']=='like'){
 $table_data[]= array("PageID"=>$row['PageID'],"PageTitle"=>$row['PageTitle'],"Category"=>$row['Category'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"pagelike"=>$row['pagelike']);
}else if($_POST['ReportType']=='comments'){
 $table_data[]= array("PageID"=>$row['PageID'],"PageTitle"=>$row['PageTitle'],"Category"=>$row['Category'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"Comments"=>$row['Comments']);
}else if($_POST['ReportType']=='commentslike'){
$table_data[]= array("PageTitle"=>$row['PageTitle'],"Category"=>$row['Category'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"NoofCommentslike"=>$row['NoofCommentslike']);
}
else if($_POST['ReportType']=='pageview'){

$table_data[]= array("pageId"=>$row['pageId'],"PageTitle"=>$row['PageTitle'],"Category"=>$row['Category'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"pageViews"=>$row['pageViews']);
}else if($_POST['ReportType']=='useractivity'){
$table_data[]= array("EmployeeId"=>$row['EmployeeId'],"NameReport"=>$row['NameReport'],"location"=>$row['location'],"ViewedDate"=>$row['ViewedDate'],"InTime"=>$row['InTime'],"OutTime"=>$row['OutTime'],"Duration"=>$row['Duration'],"Department"=>$row['Department'],"PageViewed"=>$row['PageViewed'],);
}
else if($_POST['ReportType']=='articlepagelike'){
 $table_data[]= array("ActivityID"=>$row['ActivityID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"pagelike"=>$row['pagelike']);
}else if($_POST['ReportType']=='articlecomments'){
$table_data[]= array("ActivityID"=>$row['ActivityID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"Comments"=>$row['Comments']);
}
	}else if($_POST['Site']=='leader'){
 if($_POST['ReportType']=='like'){
 $table_data[]= array("PageID"=>$row['PageID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"pagelike"=>$row['pagelike']);
}else if($_POST['ReportType']=='comments'){
$table_data[]= array("PageID"=>$row['PageID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"Comments"=>$row['Comments']);
}else if($_POST['ReportType']=='commentslike'){
$table_data[]= array("Title"=>$row['Title'],"Category"=>$row['Category'],"NoofCommentslike"=>$row['NoofCommentslike']);
}
else if($_POST['ReportType']=='pageview'){
$table_data[]= array("PageId"=>$row['PageId'],"Title"=>$row['Title'],"Category"=>$row['Category'],"pageViews"=>$row['pageViews']);
}
else if($_POST['ReportType']=='useractivity'){
$table_data[]= array("EmployeeId"=>$row['EmployeeId'],"NameReport"=>$row['NameReport'],"location"=>$row['location'],"ViewedDate"=>$row['ViewedDate'],"InTime"=>$row['InTime'],"OutTime"=>$row['OutTime'],"Duration"=>$row['Duration'],"Department"=>$row['Department'],"PageViewed"=>$row['PageViewed'],);
}else if($_POST['ReportType']=='articlepagelike'){
 $table_data[]= array("ActivityID"=>$row['ActivityID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"pagelike"=>$row['pagelike']);
}else if($_POST['ReportType']=='articlecomments'){
$table_data[]= array("ActivityID"=>$row['ActivityID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"Comments"=>$row['Comments']);
}
 }
 else  if($_POST['Site']=='academy'){

 if($_POST['ReportType']=='like'){
 $table_data[]= array("PageID"=>$row['PageID'],"PageTitle"=>$row['PageTitle'],"maincategory"=>$row['maincategory'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"pagelike"=>$row['pagelike']);
}else if($_POST['ReportType']=='comments'){
 $table_data[]= array("PageID"=>$row['PageID'],"PageTitle"=>$row['PageTitle'],"maincategory"=>$row['maincategory'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"comments"=>$row['comments']);
}else if($_POST['ReportType']=='commentslike'){
$table_data[]= array("PageTitle"=>$row['PageTitle'],"maincategory"=>$row['maincategory'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"NoofCommentslike"=>$row['NoofCommentslike']);
}

else if($_POST['ReportType']=='pageview'){

$table_data[]= array("pageId"=>$row['pageId'],"PageTitle"=>$row['PageTitle'],"maincategory"=>$row['maincategory'],"subcategory"=>$row['subcategory'],"thirdcategory"=>$row['thirdcategory'],"pageViews"=>$row['pageViews']);
}
else if($_POST['ReportType']=='useractivity'){
$table_data[]= array("EmployeeId"=>$row['EmployeeId'],"NameReport"=>$row['NameReport'],"location"=>$row['location'],"ViewedDate"=>$row['ViewedDate'],"InTime"=>$row['InTime'],"OutTime"=>$row['OutTime'],"Department"=>$row['Department'],"PageViewed"=>$row['PageViewed'],);
}
else if($_POST['ReportType']=='articlepagelike'){
 $table_data[]= array("ActivityID"=>$row['ActivityID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"pagelike"=>$row['pagelike']);
}else if($_POST['ReportType']=='articlecomments'){
$table_data[]= array("ActivityID"=>$row['ActivityID'],"Title"=>$row['Title'],"Category"=>$row['Category'],"Comments"=>$row['Comments']);
}

 }

 }
 }
 else
 {
 	$table_data=[];
 }

 echo json_encode($table_data);
 
}
 ?>