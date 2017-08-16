<?php
session_start();
session_unset();
session_destroy();
//unset($_SESSION["login"]);
header("location:index.php");
?>