<?php // Handle remote upload
if (isset($_FILES["imageData"]["tmp_name"]))
{
$path="test/".$_FILES["imageData"]["name"];
move_uploaded_file($_FILES["imageData"]["tmp_name"],$path);
}

?>