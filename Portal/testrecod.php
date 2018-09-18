
<?php
$jsonString = "http://localhost/myer/content/add-on-selling/course/en/contentObjects.json";
$json = file_get_contents($jsonString);

$array = json_decode($json, True);

echo $array[0]["_id"];
//$obj = json_decode($json);

//print_r($array);
 //print_r($array[0]{0}->_id);
?>