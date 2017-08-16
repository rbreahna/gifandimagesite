<?php
session_start();
require 'config/database.php';
require 'functions.php';
if (isset($_SESSION["login"]))
{

if(isset($_POST['image_id']) && (!empty($_POST['image_id'])))
{
	
$image_id = test_input($_POST['image_id']);


$stmt = $db->prepare("SELECT * FROM users INNER JOIN images ON users.user_id = images.user_id WHERE images.image_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$author_email = $row['email'];




$to      = $author_email; // Send email to our user
				$subject = 'New Comment'; // Give the email a subject 
				$message = '
				 
				You have a new comment on your image.
				 http://localhost/Camagru/image.php?id='.$image_id.'
				 
				'; // Our message above including the link
				                     
				$headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers

				mail($to, $subject, $message, $headers); // Send our email

}

}

?>