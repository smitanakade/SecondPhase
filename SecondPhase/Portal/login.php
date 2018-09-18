<?php 
include_once("db_connect.php");
if(isset($_POST['submitform'])){
  session_start(); 
  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
// Attempt insert query execution
$loginCheck= "SELECT * FROM adminuser WHERE UserId='".$_POST['name']."'";
$checkResult=mysqli_query($link, $loginCheck);
$getToken= mysqli_fetch_assoc(mysqli_query($link, $loginCheck));
$Token=$getToken['Token'];
$_SESSION["token"] =$Token;
 $rowCount=mysqli_num_rows($checkResult);
 if($rowCount>0){
 header("Location: MyerAdminPortal.php"); 
 }else{
    $checkquery="SELECT * FROM userdetails WHERE EmployeeNo='".$_POST['name']."'";
    $Result=mysqli_query($link, $checkquery);
    $ResultCount=mysqli_num_rows($Result);
    
    if($ResultCount !=0){
        
        $encryptedSessionToken = md5(uniqid(rand(), true));
        $_SESSION["token"] = $encryptedSessionToken;
        $sql = "INSERT INTO adminuser (UserId, Token, PageId, PageName) VALUES ('".mysqli_escape_string($link, $_POST['name'])."', '".mysqli_escape_string($link, $encryptedSessionToken)."',NULL, NULL)";
        $result = mysqli_query($link, $sql);

     header("Location: MyerAdminPortal.php");
        
    
    } else{
      $_SESSION['Error'] = "Sorry, Team Member ID is not valid. Contact MyerAcademy@myer.com.au for support.";
      
      // Close connection
    mysqli_close($link);
  }
}
} 
?>

<html>
<head>

<script src="./js/jquery-1.12.4.min.js" type="application/javascript"></script>
<script src="./js/jquery.form-validator.min.js" type="application/javascript"></script>

<script src="./js/bootstrap.min.js" type="application/javascript"></script>
<link rel='stylesheet' type='text/css' href='./css/bootstrap.min.css'>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<script type="application/javascript" language="javascript">
var $form = $("form"),
$successMsg = $(".alert");

$form.on("submit", function(e) {
if ($form.validatr("validateForm")) {
  e.preventDefault();
  $successMsg.show();
}
});</script>

</head>
<body>

<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
                           <img src="/Portal/image/logo-m.png" >
                           <h2 class="title">Myer Academy Admin Portal- Login</h1>
	               		<hr />
	               	</div>
                </div> 
            <div>

			</div>
<div style="font-size=20; color:#FF0000;">	<?php		if( isset($_SESSION['Error']) )
{
        echo $_SESSION['Error'];
        unset($_SESSION['Error']);

}?></div>
                <div  class="container">
                <div class="row main">
                <div class="container">
  <div class="panel panel-default">
    
    <div class="panel-body">
      <!-- <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Successfully submitted!</strong> The form is valid.
      </div> -->
      <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
          <label for="name">Team Member ID:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <button type="submit" name="submitform" value="submitform" class="btn btn-default">Login</button>
      </form>

    </div>
    
  </div>
</div>
</div>                
				</div>
            </div>
</div>
		</div>
    
</body>
</html>
