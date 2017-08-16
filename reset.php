<?php
session_start();
require 'config/database.php';
require 'functions.php';
$passwordErr ="";
$newpassword ="";

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    // Verify data
    $email = test_input($_GET['email']); // Set email variable
    $hash = test_input($_GET['hash']); // Set hash variable


$stmt = $db->prepare("SELECT email, hash, activated FROM users WHERE email = ? AND hash = ? AND activated = ?");
$stmt->bindParam(1, $email);
$stmt->bindParam(2, $hash);
$stmt->bindValue(3, '1');
$stmt->execute();
$count = $stmt->rowCount();
if ($count ==1)
{

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

	if (empty($_POST["password"])) {

    $passwordErr = "Password is required";
  } else {
    $newpassword = test_input($_POST["password"]);

    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', $newpassword)) {
      $passwordErr = "Password must be 6-12 characters long, contain letters, and at least one digit"; 
    }
  }


//echo $passwordErr;
if ($passwordErr == "")
{
//echo "no error";
$password = hash('sha512',$newpassword);
$hash = hash('sha512', rand(1,1000));
$stmt = $db->prepare("UPDATE users SET password = ?, hash = ? WHERE email = ? AND activated = ?");
$stmt->bindParam(1, $password);
$stmt->bindParam(2, $hash);
$stmt->bindParam(3, $email);
$stmt->bindValue(4, '1');
$stmt->execute();


$to      = $email; // Send email to our user
$subject = 'Password Changed'; // Give the email a subject 
$message = '
 
Your password has been changed
 
------------------------
New Password: '.$newpassword.'
------------------------
 
 
'; // Our message above including the link
                     
$headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers

mail($to, $subject, $message, $headers); // Send our email
//echo '<div class="statusmsg">Your password has been reset</div>';
//echo'<a href="login.php">Login</a>';
header("location:index.php");
}


}
}


}
else
header("location:index.php");


?>

<!DOCTYPE html>
<html>
<head>
	<title>New Password</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<form action="reset.php<?php echo '?email='.$email.'&'.'hash='.$hash;?>" method ="post">
 <div class="container">
 <span class="error"><?php echo $passwordErr;?></span>
 <br>
   New Password: <input type="text" name="password" >
 				
    <button type="submit" name="submit" value="OK">Reset</button>
  </div>
</form>
</body>
</html>