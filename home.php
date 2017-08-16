<?php
session_start();
require 'config/database.php';
require 'functions.php';
if (!isset($_SESSION["login"]))
header("location:index.php");
?>


<a href="profile.php">My profile</a>
<br>


<?php
$page = 0;
$images_per_page = 6;
$pagination_limit = 5;
$buffer = floor($pagination_limit-2);
if (isset($_POST["page"])) 
{
  $page = $_POST["page"];
  $page = ($page * $images_per_page) - $images_per_page;
}
if (isset($_SESSION["page"])) 
{
  $page = $_SESSION["page"];
  $page = ($page * $images_per_page) - $images_per_page;
 $_POST["page"]= $_SESSION["page"];
 unset($_SESSION["page"]);
}

if (isset($_POST["page"])) 
{
  $curent_page = $_POST["page"];
}
else
{
	$curent_page = "1";
}


$stmt = $db->query("SELECT * FROM images ORDER BY image_id DESC LIMIT $page, $images_per_page");
$stmt1 = $db->query("SELECT * FROM images");
$count = $stmt1->rowCount();
$a = $count/$images_per_page;
$a = ceil($a);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	?>
	<a href = "image.php?id=<?php echo htmlentities($row['image_id']);?>&page=<?php echo htmlentities($curent_page);?>"> <img src = "<?php echo htmlentities($row['link']);?>" width = "400" height = "300"> </img></a>
	<?php
}

echo "<br>";
?>
<form method = "post">
<?php
	if (isset($_POST["page"])) 
 		$j = $_POST["page"];
 	else $j = 1;
 	if ($j <= $buffer)
 		$j = $buffer+1;

for ($i = $j-$buffer; $i <= $j+1; $i++) 
{ 

	if ($i <= $a)
	{
		if ((isset($_POST["page"]) && $i == $_POST["page"] ) || ($i == 1 && (!isset($_POST["page"]))))
		{
			?>
			<input type="submit" value = "<?php echo $i;?>" name = "page" style="background-color: red">
			<?php

		}
		else
		{
		?>
		<input type="submit" value = "<?php echo $i;?>" name = "page">
		<?php
		}
	}

}


//}
//else
//header("location:index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<body>
<br>
<a href="logout.php">Logout</a>
</body>
</html>