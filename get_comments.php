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
			$date = date('Y-m-d H:i:s', time());
			$stmt->execute();



		$stmt = $db->prepare("SELECT * FROM comments WHERE image_id = ? ORDER BY c_time ASC");
		$stmt->bindParam(1, $image_id);
		$stmt->execute();
		$count = $stmt->rowCount();

		$code = "";
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<?php ob_start(); ?>
			<div class="comment_box"> <?php echo htmlentities($row['comment']);?>
			<span class="c_time"><?php echo htmlentities($row['c_time']);?></span>
			</div>
			<?php $a = ob_get_clean(); ?>
			<?php
			$code = $code.$a;
		}


				echo $code;

				

}
}
?>