<!DOCTYPE html>
<html>
<head>
	<title>SETUP</title>
</head>
<body>

<form action="setup.php">
    <input type="submit" name="Create" value="Create All"/>
    <input type="submit" name="Delete" value="Delete All"/>
</form>

<?php
include 'database.php';


$host="localhost"; 


 if (isset($_GET['Create']))
 {

    try {
        $dbh = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);

        $dbh->exec("CREATE DATABASE IF NOT EXISTS `$DB_NAME`;
                CREATE USER '$DB_USER'@'$DB_HOST' IDENTIFIED BY '$DB_PASSWORD';
                GRANT ALL ON `$DB_NAME`.* TO '$DB_USER'@'$DB_HOST';
                FLUSH PRIVILEGES;");

        $sql = "USE camagru";
        $dbh->exec($sql);


        $sql = "CREATE TABLE IF NOT EXISTS users
        (user_id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(30) NOT NULL,
         email VARCHAR(50) NOT NULL,
         password CHAR(128),
         hash CHAR(128),
         activated ENUM('1', '0'))";
        $dbh->exec($sql);

        $pass1 = hash('sha512','user1pass123');
        $hash1 = hash('sha512','1');
        $sql = "INSERT INTO users (username, email, password, hash, activated) Values ('user1','user1@email.com', '$pass1', '$hash1', '1')";
        $dbh->exec($sql);

        $pass2 =hash('sha512','user2pass123');
        $hash2 = hash('sha512','2');
        $sql = "INSERT INTO users (username, email, password, hash, activated) Values ('user2','user2@email.com', '$pass2', '$hash2', '1')";
        $dbh->exec($sql);

        $pass3 =hash('sha512','user3pass123');
        $hash3 = hash('sha512','3');
        $sql = "INSERT INTO users (username, email, password, hash, activated) Values ('user3','user3@email.com', '$pass3', '$hash3', '1')";
        $dbh->exec($sql);




         $sql = "CREATE TABLE IF NOT EXISTS images
        (image_id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       	 user_id INT(20) UNSIGNED,
         link VARCHAR(200) NOT NULL)";
        $dbh->exec($sql);

        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/user1image.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/user1image2.jpg')";
        $dbh->exec($sql);

        $sql = "INSERT INTO images (user_id, link) Values ('2','./images/user2image.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('2','./images/user2image2.jpg')";
        $dbh->exec($sql);

        $sql = "INSERT INTO images (user_id, link) Values ('3','./images/user3image.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('3','./images/user3image2.jpg')";
        $dbh->exec($sql);

        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image3.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image4.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image5.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image6.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image7.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image8.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('1','./images/image9.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image10.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image11.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image12.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image13.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image14.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image15.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image16.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image17.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image18.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image19.jpg')";
        $dbh->exec($sql);
        $sql = "INSERT INTO images (user_id, link) Values ('4','./images/image20.jpg')";
        $dbh->exec($sql);



        $sql = "CREATE TABLE IF NOT EXISTS likes
        (image_id INT(20) UNSIGNED,
       	 user_id INT(20) UNSIGNED,
         liked ENUM('1', '0'))";
        $dbh->exec($sql);

         $sql = "INSERT INTO likes (image_id, user_id, liked) Values ('1','2','1')";
        $dbh->exec($sql);
        $sql = "INSERT INTO likes (image_id, user_id, liked) Values ('1','3','1')";
        $dbh->exec($sql);
        $sql = "INSERT INTO likes (image_id, user_id, liked) Values ('2','1','1')";
        $dbh->exec($sql);
        $sql = "INSERT INTO likes (image_id, user_id, liked) Values ('3','2','1')";
        $dbh->exec($sql);
        $sql = "INSERT INTO likes (image_id, user_id, liked) Values ('3','2','1')";
        $dbh->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS ro_texts
        (tag_id INT(20) UNSIGNED,
         tag_text TEXT,
         c_time DATETIME)";
        $dbh->exec($sql);

         $sql = "INSERT INTO ro_texts (tag_id, tag_text, c_time) Values ('1','numele meu este eugen',now())";
        $dbh->exec($sql);
        $sql = "INSERT INTO ro_texts (tag_id, tag_text, c_time) Values ('2','eu sunt un baiat bun', now())";
        $dbh->exec($sql);
         $sql = "INSERT INTO ro_texts (tag_id, tag_text, c_time) Values ('3','si foarte homosexual', now())";
        $dbh->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS en_texts
        (tag_id INT(20) UNSIGNED,
         tag_text TEXT,
         c_time DATETIME)";
        $dbh->exec($sql);

         $sql = "INSERT INTO en_texts (tag_id, tag_text, c_time) Values ('1','hello my name is ceban',now())";
        $dbh->exec($sql);
        $sql = "INSERT INTO en_texts(tag_id, tag_text, c_time) Values ('2','this is a sample text', now())";
        $dbh->exec($sql);
         $sql = "INSERT INTO en_texts (tag_id, tag_text, c_time) Values ('3','ceban eugen is gay', now())";
        $dbh->exec($sql);




         $sql = "CREATE TABLE IF NOT EXISTS comments
        (image_id INT(20) UNSIGNED,
       	 user_id INT(20) UNSIGNED,
         comment TEXT,
         c_time DATETIME(3))";
        $dbh->exec($sql);


        // class testing, remove before deploy


         

      //  $t=date("Y-m-d H:i:s");
       // now()
        $sql = "INSERT INTO comments (image_id, user_id, comment, c_time) Values ('1','2','comment from second user on first image', now())";
        $dbh->exec($sql);
        $sql = "INSERT INTO comments (image_id, user_id, comment, c_time) Values ('1','3','comment from third user on first image', now())";
        $dbh->exec($sql);
        $sql = "INSERT INTO comments (image_id, user_id, comment, c_time) Values ('2','1','comment from first user on second image', now())";
        $dbh->exec($sql);
        $sql = "INSERT INTO comments (image_id, user_id, comment, c_time) Values ('3','2','another from second user on third image', now())";
        $dbh->exec($sql);
        $sql = "INSERT INTO comments (image_id, user_id, comment, c_time) Values ('3','2','yet another from second on third image', now())";
        $dbh->exec($sql)


   		 

        or die(print_r($dbh->errorInfo(), true));

    } 
    catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
unset($_GET);
header("location:setup.php");
}

if (isset($_GET['Delete']))
 {

    try {
        $dbh = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);

        $dbh->exec("DROP DATABASE IF EXISTS `$DB_NAME`")
        or die(print_r($dbh->errorInfo(), true));
    } 
    catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
   unset($_GET);
header("location:setup.php");
}


?>


</body>
</html>