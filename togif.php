<?php
session_start();
error_reporting(0);
require 'config/database.php';
require 'functions.php';
include "GIFEncoder.class.php";
/*
	Build a frames array from sources...
*/
if (isset($_SESSION["login"]))
{
	$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bindParam(1, $_SESSION["login"]);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['user_id'];


if(isset($_POST['folder']) && !empty($_POST['folder']))
{
//sleep(7);
$foldername = $_POST['folder'];
//echo $foldername;
//echo "<br>";
$pathtofolder = "images/".$foldername;
//echo $pathtofolder;
//echo "<br>";
$pathtogiffolder = $pathtofolder."/"."temp";

if (!file_exists($pathtogiffolder)) {
    mkdir($pathtogiffolder, 0777, true);
}

if ( $dh = opendir ( $pathtofolder ) ) {
	while ( false !== ( $dat = readdir ( $dh ) ) ) {
		if ( $dat != "." && $dat != ".." && !is_dir($pathtofolder."/".$dat)) {


			//echo $dat;
			$image = imagecreatefrompng($pathtofolder."/".$dat);

			$format = $dat;
			$format = str_replace(".png",".gif", $format);
			// Save the image as a GIF
			//echo $format;
			//echo "<br>";
			imagegif($image, $pathtogiffolder."/".$format);

				// Free from memory
				imagedestroy($image);


			$frames [ ] = $pathtogiffolder."/".$format;
			$framed [ ] = 8;
		}
	}
	closedir ( $dh );
}
/*
		GIFEncoder constructor:
        =======================

		image_stream = new GIFEncoder	(
							URL or Binary data	'Sources'
							int					'Delay times'
							int					'Animation loops'
							int					'Disposal'
							int					'Transparent red, green, blue colors'
							int					'Source type'
						);
*/
$gif = new GIFEncoder	(
							$frames,
							$framed,
							0,
							2,
							0, 0, 0,
							"url"
		);
/*
		Possibles outputs:
		==================

        Output as GIF for browsers :
        	- Header ( 'Content-type:image/gif' );
        Output as GIF for browsers with filename:
        	- Header ( 'Content-disposition:Attachment;filename=myanimation.gif');
        Output as file to store into a specified file:
        	- FWrite ( FOpen ( "myanimation.gif", "wb" ), $gif->GetAnimation ( ) );
*/
//Header ( 'Content-type:image/gif' );


$name = uniqid("", False);
$imgName = $_SESSION["login"].$name.".gif";

$path = "images/".$imgName;


 FWrite ( FOpen ( $path, "wb" ), $gif->GetAnimation ( ) );


$stmt = $db->prepare("INSERT INTO images (user_id, link) Values (:user_id,:link)");
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':link', $path);
				$stmt->execute();



 $files = glob($pathtofolder.'/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

$files = glob($pathtogiffolder.'/*'); // get all file names
foreach($files as $file){ // iterate files
    unlink($file); // delete file
}

rmdir($pathtogiffolder);
rmdir($pathtofolder);
//echo	$gif->GetAnimation ( );
echo $path;

}
}
?>
