<?php
session_start();
require 'config/database.php';
require 'functions.php';

if (isset($_SESSION["login"]))
{

if(isset($_POST['refresh']) && $_POST['refresh']=="1")
	{		
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bindParam(1, $_SESSION["login"]);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['user_id'];


$stmt = $db->prepare("SELECT * FROM images WHERE user_id = ? ORDER BY image_id DESC");
		$stmt->bindParam(1, $user_id);
		$stmt->execute();
		$count = $stmt->rowCount();

if ($count!=0)
{
	$code = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	
	?>
	<?php ob_start(); ?>
	<div>
	<img class ="user_images" src = "<?php echo htmlentities($row['link']);?>"> </img>
	<br>
	<a href="image.php?id=<?php echo htmlentities($row['image_id']);?>"><button>View</button></a>
	<button onclick='delete_image(<?php echo $row['image_id']; ?>);'>Delete</button>
	</div>
	<br>
	<?php $a = ob_get_clean(); ?>
	<?php
	$code = $code.$a;
}

}
echo $code;
}
}

?>
