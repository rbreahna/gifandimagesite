<?php
date_default_timezone_set('Europe/Bucharest');
$DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'camagru';
$DB_HOST = "mysql:host=localhost;charset=utf8";

try {
$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//var_dump($db);
}

catch(PDOException $e){
	echo "Something went wrong";
	echo $e->getMessage();
}

?>