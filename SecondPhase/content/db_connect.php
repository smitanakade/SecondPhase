<?php
$servername ="sws-rds-rdscluster-ftymysjzygqs.cluster-czkcmxeov0vn.ap-southeast-2.rds.amazonaws.com";
$username = "myeracademy";
$password = "W6Omn8zM2T03paA";
$dbname = "myeracademy";

$link = mysqli_connect($servername, $username, $password,$dbname);
if(!$link){
    die('Could not connect: ' . mysql_error());
}?>