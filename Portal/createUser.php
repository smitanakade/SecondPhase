<?php 
include_once("check.php");

if(isset($_POST['Submit'])){
    include_once("db_connect.php");
    
    
 if($conn){ 
$query = "INSERT INTO userdetails(UserName,Designation,UserLogin,updateOn,EmailId,ContactNumber,Location,Access) VALUES('".mysql_real_escape_string($_POST['Uname'])."','".mysql_real_escape_string($_POST['Designation'])."','".mysql_real_escape_string($_POST['UserLogin'])."',NOW(),'".mysql_real_escape_string($_POST['EmailId'])."','".mysql_real_escape_string($_POST['ContactNumber'])."','".mysql_real_escape_string($_POST['Location'])."','".mysql_real_escape_string($_POST['Access'])."' )";
$result =mysql_query($query);
if($result){
    echo "Agent Added Successfully";
    
}
    else{
echo"didnt";
    }
}
}else{
    echo "No Connection";
}

?>

<html>
<head>
<script src="./js/jquery.js" type="application/javascript"></script>
<script src="./js/jquery.validate.js" type="application/javascript"></script>

<script type="application/javascript" language="javascript">

</script>

</head>
<body>
<form action="" method="post"  name="RegForm" id="RegForm" autosubmit="off" onSubmit="return CheckRegister();">
UserName <input type="text" name="Uname" id="Uname">
        Designation <input type="text" name="Designation" id="Designation">
        UserLogin <input type="text" name="UserLogin" id="UserLogin">
        UserPassword <input type="text" name="UserPassword" id="UserPassword">
        EmailId <input type="text" name="EmailId" id="EmailId">
        ContactNumber <input type="text" name="ContactNumber" id="ContactNumber">
        Location <input type="text" name="Location" id="Location">
        Access <input type="text" name="Access" id="Access">
        <input name="Submit" type="submit" class="paybutton" value="Submit" />
    </form>
</body>
</html>
