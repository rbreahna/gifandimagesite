<?php
session_start();
require 'config/database.php';
require 'functions.php';

if (isset($_SESSION["temp_login"]) && isset($_SESSION["email"]) && isset($_SESSION["password"]) && isset($_SESSION["activated"]) && $_SESSION["activated"] =='0')
{

	$login = $_SESSION["temp_login"];
	$email = $_SESSION["email"];
	$password = hash('sha512',$_SESSION["password"]);
	$hash = hash('sha512', rand(1,1000));

$stmt = $db->prepare("INSERT INTO users (username, email, password, hash, activated) Values (?,?,?,?,?)");

$stmt->bindParam(1, $login);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $password);
$stmt->bindParam(4, $hash);
$stmt->bindValue(5, '0');
$stmt->execute();



$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$login.'
Password: '.$_SESSION["password"].'
------------------------
 
Please click this link to activate your account:
http://localhost/Camagru/complete.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers

mail($to, $subject, $message, $headers); // Send our email
session_unset();
session_destroy();
//unset($_SESSION["login"]);
echo 'mail sent';

}
else
header("location:index.php");


?>



<!DOCTYPE html>
<html>
<head>
	<title>Verification</title>
</head>
<body>

</body>
</html>