<?php
session_start();
require 'config/database.php';
require 'functions.php';

if (isset($_SESSION["login"]))
{

			$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bindParam(1, $_SESSION["login"]);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['user_id'];

if(isset($_GET['image_id']) && !empty($_GET['image_id']) && $_GET['action'] == 1)
	{
    
  	  	$image_id = test_input($_GET['image_id']); // Set email variable

  	  	$stmt = $db->prepare("SELECT * FROM likes WHERE user_id = ? AND image_id = ? AND liked = ?");
			$stmt->bindParam(1, $user_id);
			$stmt->bindParam(2, $image_id);
			$stmt->bindValue(3, '1');
			$stmt->execute();
			$count = $stmt->rowCount();
		
			if ($count == 0)
			{
				$stmt = $db->prepare("INSERT INTO likes (image_id, user_id, liked) Values (?,?,?)");
				$stmt->bindParam(1, $image_id);
				$stmt->bindParam(2, $user_id);
				$stmt->bindValue(3, '1');
				$stmt->execute();
			echo "1";
			}
			else
			{
			$stmt = $db->prepare("DELETE FROM likes WHERE image_id = ? AND user_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->bindParam(2, $user_id);
			$stmt->execute();
			echo "0";
			}

	}

}

?>