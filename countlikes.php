<?php
session_start();
require 'config/database.php';
require 'functions.php';

if (isset($_SESSION["login"]))
{

if(isset($_GET['image_id']) && !empty($_GET['image_id']))
	{
    
  	  	$image_id = test_input($_GET['image_id']); // Set email variable

  	  	$stmt = $db->prepare("SELECT SUM(liked) AS total FROM likes WHERE image_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$likes = $row['total'];
			if ($likes != null)
			echo $likes;
			else
			echo "0";

	}

}

?>