<?php
include_once ("db_connect.php");
if (isset($_POST))
	{
/*Taking total number of like for particular  page*/
	// Onload code and Read comments code

	if ($_POST['Flag'] == 'page')
		{

			$date = date('Y-m-d');
			$loadQuery = "Select * from usertracking where UserId='" . mysqli_real_escape_string($link, $_POST['UserId']) . "' and  pageId ='" . mysqli_real_escape_string($link, $_POST['PageID']) . "' and onDate='".$date."'";
			$loadResult = mysqli_query($link,$loadQuery);
			$loadcount = mysqli_num_rows($loadResult);	
		
		if ($loadcount==0)
			{
			$loadInsertQuery="INSERT INTO usertracking (UserId,pageId,pageName,InTime,OutTime,PageCategory,onDate) values('" . mysqli_real_escape_string($link, $_POST['UserId']) . "','" . mysqli_real_escape_string($link, $_POST['PageID']) . "','pagename',now(),'','".mysqli_real_escape_string($link,$_POST['pgCat'])."','".$date."')";
			mysqli_query($link,$loadInsertQuery);
	
		}
	}
if ($_POST['Flag'] == 'unload')
{
	echo "UNLOAD";
	$date = date('Y-m-d');
	
	$unloadQuery = "Select * from usertracking where UserId='" . mysqli_real_escape_string($link, $_POST['UserId']) . "' and  pageId ='" . mysqli_real_escape_string($link, $_POST['PageID']) . "' and onDate='".$date."'";
	$unloadResult = mysqli_query($link,$unloadQuery);
	$unloadcount = mysqli_num_rows($unloadResult);
	echo $unloadQuery;
	if ($unloadcount)
	{	
		$unloadUpdateQuery= "UPDATE usertracking SET OutTime=now()  where PageId ='" . mysqli_real_escape_string($link, $_POST['PageID']) . "' and UserId='" . mysqli_real_escape_string($link, $_POST['UserId']) . "' and onDate='".$date."'";
		echo $unloadUpdateQuery;
		mysqli_query($link,$unloadUpdateQuery); 
	}
}
 
	// for like comments button click


	

		

		echo json_encode($main_item);		
// Close connection
	mysqli_close($link);
	}

?>