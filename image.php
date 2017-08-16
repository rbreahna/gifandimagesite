<?php
session_start();
require 'config/database.php';
require 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>IMAGE</title>

	<script type="text/javascript" src="./scripts/image.js"></script>
	<link rel="stylesheet" href="css/comments.css">
	<meta property="og:image" content="http://localhost/Camagru/alpha/42_logo_jpg.jpg"/>
	<meta property="og:title" content="Title"/>
	<meta property="og:url" content="http://localhost/Camagru/image.php?id=226&page=1/"/>
	<meta property="og:description" content="description"/>
</head>
<body>
<?php
if (!isset($_SESSION["login"]))
header("location:index.php");

			$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bindParam(1, $_SESSION["login"]);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['user_id'];



	if(isset($_GET['id']) && !empty($_GET['id']))
	{
    
  	  	$id = test_input($_GET['id']); // Set email variable

  	  	$stmt = $db->prepare("SELECT * FROM users INNER JOIN images ON users.user_id = images.user_id WHERE images.image_id = ?");
			$stmt->bindParam(1, $id);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$author_email = $row['email'];

		$stmt = $db->prepare("SELECT * FROM images WHERE image_id = ?");
		$stmt->bindParam(1, $id);
		$stmt->execute();
		$count = $stmt->rowCount();

	if ($count == 1)
	{

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<img src = "<?php echo htmlentities($row['link']);?>" width = "400" height = "300"> </img>
			<br>
			<button id = 'likes' style="border: 1px solid black"></button>
			
			<script type="text/javascript">
  				 likecounter(<?php echo $id; ?>);
			</script>
			<button id = 'upvote' onclick='upvote(<?php echo $id; ?>);' style="border: 1px solid black"></button>
			<script type="text/javascript">
  				showstatus(<?php echo $id; ?>);
			</script>

			<?php
		}

		$stmt = $db->prepare("SELECT * FROM comments WHERE image_id = ? ORDER BY c_time ASC");
		$stmt->bindParam(1, $id);
		$stmt->execute();
		$count = $stmt->rowCount();

		?>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-share-button" data-href="http://www.google.com" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2FCamagru%2Fimage.php%3Fid%3D226%26page%3D1&amp;src=sdkpreparse">Share</a></div>

		<div id="parent">
		<?php

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<div class="comment_box"> <?php echo htmlentities($row['comment']);?>
			<span class="c_time"><?php echo htmlentities($row['c_time']);?></span>
			</div>
			<?php
		}
	
		?>
		</div>
		<?php

	}

	}
	if(isset($_GET['page']) && !empty($_GET['page']))
	$_SESSION['page'] = $_GET['page'];
	else
		$_GET['page'] = '1';

?>


 <div class="container">
    <label>Comment</label>
    <input type="text" placeholder="Enter Comment" id="comment">
    <button id ='addcomment' onclick='new_comment(<?php echo $id; ?>);'>Post</button>
  </div>

<br>
<a href="profile.php">My profile</a>
<br>
<a href="logout.php">Logout</a>
<br>
<a href="home.php">Home</a>
<script type="text/javascript">
setInterval(function(){likecounter(<?php echo $id;?>);}, 1000 );
</script>
</body>
</html>