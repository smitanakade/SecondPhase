<?php
//check.php
include_once("db_connect.php");
session_start();

if (isset($_SESSION["token"]))
{
	$token = $_SESSION["token"];
	$sql = "SELECT * FROM adminuser WHERE Token='".mysqli_escape_string($link, $token)."'";
	$result = mysqli_query($link, $sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 0)
	{
		header("Location: login.php");
	}
}
else
{
	header("Location: login.php");
}
?>