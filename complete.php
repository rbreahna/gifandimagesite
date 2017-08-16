<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/complete.css">
</head>
<body>




<?php
require 'config/database.php';
require 'functions.php';
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    // Verify data
    $email = test_input($_GET['email']); // Set email variable
    $hash = test_input($_GET['hash']); // Set hash variable



$stmt = $db->prepare("SELECT email, hash, activated FROM users WHERE email = ? AND hash = ? AND activated = ?");
$stmt->bindParam(1, $email);
$stmt->bindParam(2, $hash);
$stmt->bindValue(3, '0');
$stmt->execute();
$count = $stmt->rowCount();
if ($count ==1)
{

$stmt = $db->prepare("UPDATE users SET activated=? WHERE email = ? AND hash = ? AND activated = ?");
$stmt->bindValue(1, '1');
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $hash);
$stmt->bindValue(4, '0');

$stmt->execute();
echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
echo'<a href="login.php">Login</a>';

//header("location:index.php");

?>





<div class="alert-mesage">You will be redirected in </div>
<span id="counter">5</span> second(s)
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)=0) {
        location.href = 'index.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>



<?php


}


}
else
header("location:index.php");

?>

</body>
</html>