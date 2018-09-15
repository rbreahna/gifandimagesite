<?php
session_start();
require 'config/database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>
<?php
if (isset($_POST["login"]) && isset($_POST["password"]))
{
    //var_dump(hash('sha512', $_POST["password"]));
$stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND activated = ?");
$stmt->bindValue(1, $_POST["login"]);
$stmt->bindValue(2, hash('sha512', $_POST["password"]));
$stmt->bindValue(3, '1');
$stmt->execute();
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);
$count = $stmt->rowCount();

if ($count ==1)
{
$_SESSION["login"] = $_POST["login"];
header("location:home.php");
}
else
{
?>
<div class ='alert-mesage'>Username or Password is wrong, or your account has not been activated yet</div>
<?php
}
}
?>

<body class="login-body">
<form  action="login.php" method ="post">
 <div class="form">
 <a href="login.php"><div class = "formbuttons1">Log In</div></a>
 <a href="register.php"><div class = "formbuttons2">Sign Up</div></a>
 <br>
 <h1>Welcome Back!</h1>
    
    <input class="login-input" type="text" placeholder="Enter Username" name="login">
    <br>
    <input class="login-input" type="password" placeholder="Enter Password" name="password">
    <br>
    <a class="login-forgotpass" href="forgot.php">Forgot Password?</a>
    <button class="login-button" type="submit" name="submit" value="OK">Log In</button>
  </div>
</form>
<a href="config/setup.php">SETUP</a>
</body>
</html>