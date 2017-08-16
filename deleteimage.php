<?php
session_start();
require 'config/database.php';
require 'functions.php';
if (isset($_SESSION["login"]))
{

if(isset($_POST['id']) && !empty($_POST['id']))
	{
    
  	  	$image_id = test_input($_POST['id']);


			$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bindParam(1, $_SESSION["login"]);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['user_id'];


			$stmt = $db->prepare("SELECT * FROM images WHERE image_id = ? AND user_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->bindParam(2, $user_id);
			$stmt->execute();
			$count = $stmt->rowCount();
			


if ($count == 1)
{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$link = $row['link'];
			unlink($link);

			$stmt = $db->prepare("DELETE FROM images WHERE image_id = ? AND user_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->bindParam(2, $user_id);
			$stmt->execute();

			$stmt = $db->prepare("DELETE FROM comments WHERE image_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->execute();

			$stmt = $db->prepare("DELETE FROM likes WHERE image_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->execute();


}
}
}
else
header("location:index.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>DELETE</title>
</head>
<body>
</body>
</html>