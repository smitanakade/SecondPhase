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
	

</style>

<?php
include_once("db_connect.php");
//include_once("check.php");
if (isset($_POST["name"]))
{
session_start();

$encryptedSessionToken = md5(uniqid(rand(), true));
$_SESSION["token"] = $encryptedSessionToken;	
$pageName = "Home";
$currentURL = $_SERVER['REQUEST_URI'];
$pageId = substr($currentURL, strrpos($currentURL, '/') + 1);

$getUserID = "SELECT UserId FROM adminlogin where username='".$_POST['name']."'";
$result = mysqli_query($link,$getUserID);
$value = mysqli_fetch_object($result);
$userid = $value->UserId;
$num_rows = mysqli_num_rows($result);

if ($num_rows == 0)
{
	header("Location: login.php");
}
// Attempt insert query execution
$sql = "INSERT INTO adminuser (UserId, Token, PageId, PageName) VALUES ('".mysqli_escape_string($link, $userid)."', '".mysqli_escape_string($link, $encryptedSessionToken)."', '".mysqli_escape_string($link, $pageId)."', '".mysqli_escape_string($link, $pageName)."')";
$result = mysqli_query($link, $sql);
}
else
{
	header("Location: login.php");
}

include_once("menu.php");
?>
