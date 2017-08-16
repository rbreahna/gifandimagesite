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

		if(isset($_POST['comment']) && !empty($_POST['comment'])&&(isset($_POST['image_id'])&& !empty($_POST['image_id'])))
			{
				$comment = test_input($_POST['comment']);
				$image_id = test_input($_POST['image_id']);


		$stmt = $db->prepare("SELECT * FROM users INNER JOIN images ON users.user_id = images.user_id WHERE images.image_id = ?");
			$stmt->bindParam(1, $image_id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$author_email = $row['email'];


		$stmt = $db->prepare("INSERT INTO comments (image_id, user_id, comment, c_time) Values (:image_id,:user_id,:comment, now(3))");
				$stmt->bindParam(':image_id', $image_id);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':comment', $comment);
				//$stmt->bindValue(':c_time', now(3));
				$date = date('Y-m-d H:i:s', time());
				echo $date.".000";
				$stmt->execute();

				
				//$milliseconds = round(microtime(true)/1000);
				

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