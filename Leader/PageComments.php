<?php
include_once ("db_connect.php");
if (isset($_POST))
	{
		$userAgent     =   $_SERVER['HTTP_USER_AGENT'];
		
		function detectDevice(){
			$userAgent = $_SERVER["HTTP_USER_AGENT"];
			$devicesTypes = array(
				"computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
				"tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
				"mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
				"bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
			);
			 foreach($devicesTypes as $deviceType => $devices) {           
				foreach($devices as $device) {
					if(preg_match("/" . $device . "/i", $userAgent)) {
						$deviceName = $deviceType;
					}
				}
			}
			return ucfirst($deviceName);
			 }
function getBrowser() {
				
					global $userAgent;
					$browser        =   "Unknown Browser";
					$browser_array  =   array(
											'/msie/i'       =>  'Internet Explorer',
											'/firefox/i'    =>  'Firefox',
											'/safari/i'     =>  'Safari',
											'/chrome/i'     =>  'Chrome',
											'/opera/i'      =>  'Opera',
											'/netscape/i'   =>  'Netscape',
											'/maxthon/i'    =>  'Maxthon',
											'/konqueror/i'  =>  'Konqueror',
											'/mobile/i'     =>  'Handheld Browser'
										);
				
					foreach ($browser_array as $regex => $value) { 
				
						if (preg_match($regex, $userAgent)) {
							$browser    =   $value;
						}
				
					}
				
					return $browser;
				
				}
$user_browser   =   getBrowser();
$deviceData=detectDevice();
$browserData=$user_browser."-".$deviceData;
/*Taking total number of like for particular  page*/

	$result = mysqli_query($link, "SELECT * from articalactivity where PageId ='" . mysqli_real_escape_string($link, $_POST['PageID']) . "' and UserId='" . mysqli_real_escape_string($link, $_POST['UserId']) . "'");

	// Onload code and Read comments code

	if ($_POST['Flag'] == 'page')
		{

			$date = date('Y-m-d');
			$device =$_POST['res'];
			
		/* 	$loadQuery = "Select * from usertracking where UserId='" . mysqli_real_escape_string($link, $_POST['UserId']) . "' and  pageId ='" . mysqli_real_escape_string($link, $_POST['PageID']) . "' and onDate='".$date."'";
			$loadResult = mysqli_query($link,$loadQuery);
			$loadcount = mysqli_num_rows($loadResult);	
		
		if ($loadcount==0)
			{ */
				$device =$_POST['res'];
			$loadInsertQuery="INSERT INTO usertracking (UserId,pageId,pageName,InTime,OutTime,PageCategory,Resolution,Browser,onDate) values('" . mysqli_real_escape_string($link, $_POST['UserId']) . "','" . mysqli_real_escape_string($link, $_POST['PageID']) . "','pagename',now(),'','".mysqli_real_escape_string($link,$_POST['pgCat'])."','".$device."','".$browserData."','".$date."')";
			mysqli_query($link,$loadInsertQuery);
			$likeCheck="SELECT * FROM LeaderLMPagelike WHERE PageID='".mysqli_real_escape_string($link, $_POST['PageID'])."' and UserID='".mysqli_real_escape_string($link, $_POST['UserId'])."'";
			//echo $likeCheck;
			$Result = mysqli_query($link,$likeCheck);
			$count = mysqli_num_rows($Result); 
			if($count>0){
			echo '<i class="fa fa-fw fa-heart faView"></i>';
			}
		//}
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


	

		

		//echo json_encode($main_item);		
// Close connection
	mysqli_close($link);
	}

?>