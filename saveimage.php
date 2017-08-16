<?php
session_start();
require 'config/database.php';
require 'functions.php';

if (isset($_SESSION["login"]))
{


if(((isset($_POST['image_data']) && !empty($_POST['image_data'])) || (isset($_POST['upload']) && !empty($_POST['upload']))) && isset($_POST['super']) && !empty($_POST['super']))
{

	$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bindParam(1, $_SESSION["login"]);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['user_id'];

$name = uniqid("", False);
$imgName = $_SESSION["login"].$name.".png";
$path = "./images/".$imgName;
if(isset($_POST['image_data'])&& !empty($_POST['image_data'])&& !(isset($_POST['upload']) && !empty($_POST['upload'])))
{
$img = $_POST['image_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
file_put_contents($path, $fileData);
}
else if(isset($_POST['upload']) && !empty($_POST['upload']))
{
$img = $_POST['image_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
file_put_contents($path, $fileData);
}

$selector = $_POST['super'];

switch ($selector) {
    case "image1":
       $top_path = './alpha/insect.png';
        break;
    case "image2":
        $top_path = './alpha/insect2.png';
        break;
    case "image3":
        $top_path = './alpha/Curtain.png';
        break;
    default:
        $top_path = './alpha/insect.png';

}


$base = imagecreatefrompng($path);
//logo is transparent
$logo = imagecreatefrompng($top_path);
list($width, $height) = getimagesize($path);
$logo = resizePng($logo, $width, $height);

//Adjust paramerters according to your image
imagecopymerge_alpha($base, $logo, 0, 0, 0, 0, $width, $height, 100);

header('Content-Type: image/png');
imagepng($base, $path);



$stmt = $db->prepare("INSERT INTO images (user_id, link) Values (:user_id,:link)");
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':link', $path);
				$stmt->execute();


}

}
?>