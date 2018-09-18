<?php 
 include("db_connect.php");
 if(isset($_POST['export']))  
 {  

if($_POST['reportname']!=''){
header('Content-Type: text/csv; charset=utf-8');  
 header('Content-Disposition: attachment; filename=' . $_POST['reportname'] .'_'.date('Y-m-d').'.csv');

}
 $output = fopen("php://output", "w"); 
 //Start-For site All
 if($_POST['Site']=='all'){
 if($_POST['reportname']=='like'){
   fputcsv($output, array('Page Title', 'Category','sub category','third category','Number of Likes'));
//Query 1
	 $sql1="(SELECT la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId 
	 WHERE pl.`pageLike`='like'";
echo $sql1;
	 if($_POST['Location']!=''){
unset($sql1);

 $sql1="(SELECT la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and  ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";
   echo $sql1;
}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql1 .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql1);

  $sql1="(SELECT la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId  
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 } 
 echo $sql1;
}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql1 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". date('Y-m-d')."')";
}
}



//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql1 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}


 $sql1 .= "group by pl.`PageID`)";
  //Query 2
  $sql2="(SELECT la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId 
   WHERE pl.`pageLike`='like'";
   echo $sql2;
	 	 if($_POST['Location']!=''){
unset($sql2);

 $sql2="(SELECT la.`PageTitle`,
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

  $sql2="(SELECT la.`PageTitle`,
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
 $sql2 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". date('Y-m-d')."')";
}
}


//	 if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql2 .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

	  $sql2 .= "group by pl.`PageID`)";

	  //Join query 1 and query 2

	  $sql=$sql1." UNION ALL" .$sql2;
	  
}else if($_POST['reportname']=='comments'){
 fputcsv($output, array('Page Title', 'Category','sub category','third category','Number of Comments'));
		 $sql1="(SELECT la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(ac.`Comment`) as Comments 
			 FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql1);

 $sql1="(SELECT la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(ac.`Comment`) as Comments 
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
  $sql1="(SELECT la.Title as PageTitle,la.Category,'' as subcategory,'' as thirdcategory,count(ac.`Comment`) as Comments 
  FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
 inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }

}
if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql1 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". date('Y-m-d')."')";
}
}

// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql1 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql1 .= "group by ac.`PageID`)";

  $sql2="(SELECT la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as Comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId  
	WHERE pl.`Comment`!=''";
	if($_POST['Location']!=''){
unset($sql2);

 $sql2="(SELECT la.`PageTitle`,
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
  $sql2="(SELECT la.`PageTitle`,
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
 $sql2 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". date('Y-m-d')."')";
}
}
	// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql2 .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

	  $sql2 .= "group by pl.`PageID`)";

	  $sql=$sql1.' UNION ALL '.$sql2;

}

else if($_POST['reportname']=='commentslike'){
 fputcsv($output, array('Page Title', 'Category','sub category','third category','Number of Comments like'));
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
 $sql1 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
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
 $sql2 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql2 .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
// }
$sql2.="GROUP by lcl.`CommentID`)";

  $sql=$sql1.' UNION ALL '.$sql2;


}

else if($_POST['reportname']=='pageview'){
 fputcsv($output, array('Page Title', 'Category','sub category','third category','Page Views'));
 $sql1="(SELECT alm.Title as PageTitle,alm.Category,'' as subcategory,'' as thirdcategory, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId where 1=1 ";

			 if($_POST['Location']!=''){
unset($sql1);

 $sql1="(SELECT alm.Title,alm.Category,'' as subcategory,'' as thirdcategory, count(aa.`PageId`) as pageViews 
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
  $sql1="(SELECT alm.Title,alm.Category,'' as subcategory,'' as thirdcategory, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId 
                inner join userdetails ud on aa.UserId=ud.EmployeeNo
             where 1=1 and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }
 }
 if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql1 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql1 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". date('Y-m-d')."')";
}
}

//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
// $sql1 .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}

			  $sql1 .= "group by aa.PageId)";


			  $sql2="(SELECT la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as Category,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
 where 1=1 ";

  if($_POST['Location']!=''){
unset($sql2);

 $sql2="(SELECT la.`PageTitle`,
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
  $sql2="(SELECT la.`PageTitle`,
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
 $sql2 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql2 .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". date('Y-m-d')."')";
}
}

 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql2 .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}
	  $sql2.= "group by pl.pageId)";
	  $sql=$sql1.' UNION ALL '.$sql2;

} else if($_POST['reportname']=='articlepagelike'){
 fputcsv($output, array('Page Title', 'Category','pagelike'));
	 $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike 
	 FROM `leaderactivitypagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `leaderactivitypagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `leaderactivitypagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
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
// $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}
 $sql .= "group by pl.`ActivityID`";
} 

else if($_POST['reportname']=='articlecomments'){
 fputcsv($output, array('Page Title', 'Category','Comments'));
			 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `leaderactivitycomment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `leaderactivitycomment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `leaderactivitycomment` ac
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
 //if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
// $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql .= "group by ac.`ActivityID`";
}
 }
  //End-For site All
 
   //Start-For site leader

else  if($_POST['Site']=='leader'){

//For page like report
 if($_POST['reportname']=='like'){
  fputcsv($output, array('Activity Title', 'Category', 'No of Likes'));
	 $sql="SELECT la.Title,la.Category,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId
	 WHERE pl.`pageLike`='like' ";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and  ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT la.Title,la.Category,count(pl.`PageID`) as pagelike 
	 FROM `LeaderLMPagelike` pl inner join leaderlearningmoment la on pl.PageID=la.pageId
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
// $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}


 $sql .= "group by pl.`PageID`";
} 
else if($_POST['reportname']=='comments'){
 fputcsv($output, array('Activity Title', 'Category', 'No of comments'));
		$sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
 inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderLMComment` ac
inner join leaderlearningmoment la on ac.PageID=la.pageId 
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
// $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

 
 $sql .= "group by ac.`PageID`";
}
else if($_POST['reportname']=='commentslike'){
 fputcsv($output, array('Page Title', 'Category', 'No of comments like'));
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
 $sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". date('Y-m-d')."')";
}
}
// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
 //}
 $sql .= "GROUP by lcl.`CommentID`";
}

//Start-page view report-leader
else if($_POST['reportname']=='pageview'){
 fputcsv($output, array('Title', 'Category', 'Page Views'));

 $sql="SELECT alm.Title,alm.Category, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId where 1=1 ";

			 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT alm.Title,alm.Category, count(aa.`PageId`) as pageViews 
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
  $sql="SELECT alm.Title,alm.Category, count(aa.`PageId`) as pageViews 
			 FROM `usertracking` aa inner join leaderlearningmoment alm 
			 on aa.`PageId`=alm.pageId 
                inner join userdetails ud on aa.UserId=ud.EmployeeNo
             where 1=1 and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }
 }
   if($_POST['StartDate']!=''){
if($_POST['EndDate']!=''){
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". date('Y-m-d')."')";
}
}
//if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
// $sql .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}

			  $sql .= "group by aa.PageId";
}
//end - page view report-leader
//Start-User tracking report-leader
else if($_POST['reportname']=='useractivity'){
 fputcsv($output, array('Employee ID', 'NameReport', 'location', 'ViewedDate', 'InTime','OutTime','Duration','Department','PageViewed'));
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
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
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
else if($_POST['reportname']=='articlepagelike'){
 fputcsv($output, array('Activity Title', 'Category', 'No of pagelike'));
		 $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike 
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike
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

else if($_POST['reportname']=='articlecomments'){
 fputcsv($output, array('Activity Title', 'Category', 'No of comments'));
		 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
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
//end - User tracking report-leader
}
//End-For site leader

//start-for site academy
else  if($_POST['Site']=='academy'){
 if($_POST['reportname']=='like'){
   fputcsv($output, array('Page Title', 'Main Category','Sub Category','Third Category', 'No of Likes'));
	 $sql="SELECT la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`PageID`) as pagelike 
	 FROM `LMPagelike` pl inner join pageassociate la on pl.PageID=la.pageId
	 WHERE pl.`pageLike`='like'";
	 	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.`PageTitle`,
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

  $sql="SELECT la.`PageTitle`,
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
 $sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON) <='". date('Y-m-d')."')";
}
}
	// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

	  $sql .= "group by pl.`PageID`";
}

else  if($_POST['reportname']=='comments'){
  fputcsv($output, array('Page Title', 'Main Category','Sub Category','Third Category', 'No of comments'));
	 $sql="SELECT la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`Comment`) as comments 
	 FROM `LMComment` pl inner join pageassociate la on pl.PageID=la.pageId 
	WHERE pl.`Comment`!=''";
	if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.`PageTitle`,
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
  $sql="SELECT la.`PageTitle`,
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
 $sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON) <='". date('Y-m-d')."')";
}
}

	// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  (date(CommentedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(CommentedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
//}

	  $sql .= "group by pl.`PageID`";
}else if($_POST['reportname']=='commentslike'){
fputcsv($output, array('Page Title', 'Main Category','Sub Category','Third Category', 'No of comments like'));
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
 $sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON) <='". date('Y-m-d')."')";
}
}

// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
//$sql .= "and  (date(lcl.likedON) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(lcl.likedON ) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
 //}
$sql.="GROUP by lcl.`CommentID`";
}

else if($_POST['reportname']=='pageview'){
  fputcsv($output, array('Page Title', 'Main Category','Sub Category','Third Category', 'Page Views'));
$sql="SELECT la.`PageTitle`,
(select CategorieDescription from maincategories where id=la.`MainCatId`) as maincategory,
(select smDescription from subMainCategory where smId=la.smId) as subcategory,
(select thlDescription from thirdlevelgroup where thLid=la.thLid) as thirdcategory ,
count(pl.`pageId`) as pageViews 
	 FROM `AcadmeyUsertracking` pl inner join pageassociate la on pl.pageId=la.pageId 
 where 1=1 ";

  if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.`PageTitle`,
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
  $sql="SELECT la.`PageTitle`,
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
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
}else{
$sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". date('Y-m-d')."')";
}
}

// if($_POST['StartDate']!='' && $_POST['EndDate']!=''){
 //$sql .= "and  date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate ) <= '". mysqli_real_escape_string($link,$_POST['EndDate'])."'";
//}
	  $sql .= "group by pl.pageId";
			 }else if($_POST['reportname']=='useractivity'){
			 fputcsv($output, array('Employee ID', 'NameReport', 'location', 'ViewedDate', 'InTime','OutTime','Department','PageViewed'));
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
 $sql .= "and  (date(OnDate) >= '". mysqli_real_escape_string($link,$_POST['StartDate'])."' && date(OnDate) <='". mysqli_real_escape_string($link, $_POST['EndDate'])."')";
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
else if($_POST['reportname']=='articlepagelike'){
 fputcsv($output, array('Activity Title', 'Category', 'No of pagelike'));
	 $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike 
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
	 WHERE pl.`pageLike`='like'";

	 if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike
	 FROM `LeaderActivityPagelike` pl inner join leaderassociation la on pl.ActivityID=la.ID 
     inner join userdetails ud on pl.`UserID`=ud.EmployeeNo
	 WHERE pl.`pageLike`='like' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}
	 
if($_POST['Department']!=''){
 if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);

  $sql="SELECT la.Title,la.Category,count(pl.`ActivityID`) as pagelike
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

else if($_POST['reportname']=='articlecomments'){
 fputcsv($output, array('Activity Title', 'Category', 'No of comments'));
		 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
WHERE ac.`Comment`!=''";
if($_POST['Location']!=''){
unset($sql);

 $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
inner join leaderassociation la on ac.ActivityID=la.ID
  inner join userdetails ud on ac.`UserID`=ud.EmployeeNo
WHERE ac.`Comment`!='' and ud.OccStateCode='". mysqli_real_escape_string($link,$_POST['Location'])."'";

}

if($_POST['Department']!=''){
if($_POST['Location']!=''){
  $sql .= "and ud.Department ='". mysqli_real_escape_string($link,$_POST['Department'])."'";
 }else{
 unset($sql);
  $sql="SELECT la.Title,la.Category,count(ac.`Comment`) as Comments FROM `LeaderActivityComment` ac
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
//end-for site academy
  
  $result = mysqli_query($link, $sql);  
 while($row = mysqli_fetch_assoc($result))  
 {  
      fputcsv($output, $row);  
 }  
 fclose($output);



  
 }  
?>