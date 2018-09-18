<?php 
include_once("db_connect.php");
session_start();
echo "HERE".$_SESSION["token"];
if (isset($_SESSION["token"]))
{
    $token = $_SESSION["token"];
    $sql = "DELETE FROM adminuser WHERE Token='".mysqli_escape_string($link, $token)."'";
    echo $sql;
	$result = mysqli_query($link, $sql);
    
}

session_unset();
header("Location: login.php");

?>