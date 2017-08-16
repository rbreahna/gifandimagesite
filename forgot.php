<?php
session_start();
require 'config/database.php';
require 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
<link rel="stylesheet" href="css/forgot.css">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>
<body class="forgot-body">
<?php

if (isset($_POST["recovery_email"]))
{
	 $email = test_input($_POST["recovery_email"]);
	 $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND activated = ?");
	 $stmt->bindParam(1, $email);
	 $stmt->bindVAlue(2, '1');
	 $stmt->execute();
	 $count = $stmt->rowCount();
	// $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 if ($count == 1)
	 {
	 	$hash = hash('sha512', rand(1,1000));

	 	$stmt = $db->prepare("UPDATE users SET hash =? WHERE email = ? AND activated = ?");
		$stmt->bindParam(1, $hash);
		$stmt->bindParam(2, $email);
		$stmt->bindValue(3, '1');
		$stmt->execute();

$to      = $email; // Send email to our user
$subject = 'Password | Restore'; // Give the email a subject           
$message = (string)file_get_contents("test.html");
$message=str_replace("useremail", $email, $message);
$message=str_replace("userhash", $hash, $message);

// "http://localhost/Camagru/reset.php?email='.$email.'&hash='.$hash.'</div>';"


$headers = "MIME-Version: 1.0" . "\r\n";

$headers.= "Content-Type: text/html; charset=UTF-8\r\n";

$headers.= 'From:noreply@camagru.com' . "\r\n"; // Set from headers


mail($to, $subject, $message, $headers); // Send our email

		?>
		<div class ='alert-mesage'> Mail sent. Please check your inbox for a reset link</div>
		<?php


	 }
	 else
	 {
	 	?>
		<div class ='alert-mesage'>There is no account with this email, or your account has not been activated yet</div>
		<?php
	 }

}


?>


<form action="forgot.php" method ="post">
 <div class="form">
 <a href="login.php"><div class = "formbuttons1">Log In</div></a>
 <a href="register.php"><div class = "formbuttons2">Sign Up</div></a>
 <h1>Reset Password</h1>
    <input type="text" class="forgot-input" placeholder="Enter Email" name="recovery_email">
    <button class="submit-button" type="submit" name="submit" value="OK">Send recovery mail</button>
  </div>
</form>
</body>
</html>