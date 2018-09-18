<div class="container">
<h2>How To Create Simple REST API in PHP</h2>
<form class="form-inline" action="" method="POST">
<div class="form-group">
<label for="name">Search Item(Samsung, Sony, LG etc):</label>
<input type="text" name="name" class="form-control" placeholder="Enter Product Name" required/>
</div>
<button type="submit" name="submit" class="btn btn-default">Find</button>
</form>
</div>

<?php
include_once("check.php");

if(isset($_POST['submit']))	{
$name = $_POST['name'];
$url = "http://localhost/myer2/php/read.php?name=".$name;
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
$result = json_decode($response);
print_r($result);
}
?>