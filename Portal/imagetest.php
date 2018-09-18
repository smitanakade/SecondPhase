<?php
if (isset($_POST['Submit'])) {
	print_r($_POST);
 if (!empty($_FILES['upload']['name'])) {
 	$ch = curl_init();
 	$localfile = $_FILES['upload']['tmp_name'];
 	$fp = fopen($localfile, 'r');
 	curl_setopt($ch, CURLOPT_URL, '/test/'.$_FILES['upload']['name']);
 	curl_setopt($ch, CURLOPT_UPLOAD, 1);
 	curl_setopt($ch, CURLOPT_INFILE, $fp);
 	curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
 	curl_exec ($ch);
 	$error_no = curl_errno($ch);
 	curl_close ($ch);
        if ($error_no == 0) {
        	$error = 'File uploaded succesfully.';
        } else {
        	$error = 'File upload error.';
        }
 } else {
    	$error = 'Please select a file.';
 }
}?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
<div>
<label for="upload">Select file</label>
<input name="upload" type="file" />
<input type="submit" name="Submit" value="Upload" />
</div>
</form>