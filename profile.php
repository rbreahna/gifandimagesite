<?php
session_start();
require 'config/database.php';
require 'functions.php';
if (!isset($_SESSION["login"]))
header("location:index.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>PROFILE</title>
  <link rel="stylesheet" href="css/profile.css">
  <script type="text/javascript" src="./scripts/profile.js"></script>
	<script type="text/javascript" src="./scripts/webcam.js"></script>
  <script type="text/javascript" src="./scripts/gif.js"></script>

</head>
<body onload="init();">
<div style="overflow-y:auto; float: right; width: 300px; height: 800px;" id = "preview">
</div>
<script type="text/javascript" >
	preview();
</script>
    <h1>Take a snapshot of the current video stream</h1>
   Click on the Start WebCam button.
     <p>
    	<button onclick="startWebcam();">Start WebCam</button>
    	<button onclick="stopWebcam();">Stop WebCam</button> 
       <button onclick="snapshot();">Take Snapshot</button> 
       <button id="gif" onclick="makegif();">Make Gif</button> 
    </p>
    <div id="parent_container">
    <video onclick="snapshot(this);" width="400" id="video" autoplay ="true"></video>
    <div id = "upload_overlay"></div>
    <div id = "overlay"></div>

    </div>
  <p>

<div id="select_overlay">
  <img id="1" class="overlay_image" alt="image1" src="./alpha/insect.png" onclick="changealpha(this.alt)">
  <img id="2" class="overlay_image" alt="image2" src="./alpha/insect2.png" onclick="changealpha(this.alt)">
  <img id="3" class="overlay_image" alt="image3" src="./alpha/Curtain.png" onclick="changealpha(this.alt)">
  <img id="4" class="overlay_image" alt="image4" src="./alpha/1.png" onclick="changealpha(this.alt)">
  <img id="5" class="overlay_image" alt="image5" src="./alpha/11.png" onclick="changealpha(this.alt)">
  <img id="6" class="overlay_image" alt="image6" src="./alpha/3.png" onclick="changealpha(this.alt)">
  <img id="7" class="overlay_image" alt="image7" src="./alpha/14.png" onclick="changealpha(this.alt)">
</div>
<br>
<input type="file" id="myFile" multiple size="1" onchange="myFunction()" accept="image/gif, image/jpeg, image/png, image/jpg">
<p id="demo"></p>
<br><br>
        Screenshots : 
  </p>
  <div id="parent_container2">
     <canvas  id="myCanvas" width="400" height="300"></canvas> 
    <div id = "overlay2"></div>
  </div>

<br>
<a href="home.php">Home</a>
</body>
</html>