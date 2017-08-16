<!DOCTYPE HTML>  
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="css/register.css">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>
<body class="register-body">  

<?php
// define variables and set to empty values
session_start();
require 'config/database.php';
require 'functions.php';
$loginErr = $emailErr = $passwordErr ="";
$login = $email = $password ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  if (empty($_POST["login"])) {
    $loginErr = "Login is required";
  } else {
    $login = test_input($_POST["login"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/",$login)) {
      $loginErr = "Only letters, numbers, single underscores and hyphens in the middle allowed"; 
    }
    if ($loginErr =='')
    {
      $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
      $stmt->bindValue(1, $login);
      $stmt->execute();
      $count = $stmt->rowCount();
      if ($count != 0)
      {
         $loginErr = "This login is taken"; 
      }

    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }

    if ($emailErr =='')
    {
      $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bindValue(1, $email);
      $stmt->execute();
      $count = $stmt->rowCount();
      if ($count != 0)
      {
         $emailErr = "A user with this email already exists"; 
      }

    }


  }
    
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', $password)) {
      $passwordErr = "Password must be 6-12 characters long, contain letters, and at least one digit"; 
    }
  }

if ($loginErr == "" && $emailErr == "" && $passwordErr =="")
{

  $c_password = hash('sha512', $password);
  $hash = hash('sha512', rand(1,1000));

$stmt = $db->prepare("INSERT INTO users (username, email, password, hash, activated) Values (?,?,?,?,?)");

$stmt->bindParam(1, $login);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $c_password);
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
Password: '.$password.'
------------------------
 
Please click this link to activate your account:
http://localhost/Camagru/complete.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers

mail($to, $subject, $message, $headers); // Send our email
session_unset();
session_destroy();
?>
<div class ='alert-mesage'> Mail sent. Please check your inbox for an activation link</div>
<?php

}
else
{
  $_POST = array();
}

}

?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<div class="form">
<a href="login.php"><div class = "formbuttons1">Log In</div></a>
 <a href="register.php"><div class = "formbuttons2">Sign Up</div></a>
 <h1>Sign Up for Free</h1>
 <div class="error">* Required field.</div>
<input class="register-input" type="text" name="login" value="<?php echo $login;?>" placeholder="Enter Username*">
  <div class="error"><?php echo $loginErr;?></div>
<input class="register-input" type="text" name="email" value="<?php echo $email;?>" placeholder="Enter Email*">
  <div class="error"><?php echo $emailErr;?></div>
 <input class="register-input" type="text" name="password" value="<?php echo $password;?>" placeholder="Enter Password*">
  <div class="error"><?php echo $passwordErr;?></div>
  <input class="submit-button" type="submit" name="submit" value="Submit">  
</div>
</form>


</body>
</html>