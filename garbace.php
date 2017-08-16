<?php
session_start();
require 'config/database.php';
require 'functions.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["email"]))
{
	$login = test_input($_POST["login"]);
 	$email = test_input($_POST["email"]);
  	$password = test_input($_POST["password"]);
  	//$comment = test_input($_POST["comment"]);
  //	$gender = test_input($_POST["gender"]);

}
else
echo "not all field completed";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>

<!-- <script language="javascript">

function validateMe() {

if (login is blank) {
alert("Enter first name");
form.login.focus();
return false;
}

if (password is blank) {
alert("Enter last name");
form.password.focus();
return false;
}

return true;
}

</script> -->
</head>
<body>
<form action="<?php echo htmlspecialchars('register.php');?>" method ="post">
 <div class="container">
    <label>Login</label>
    <input type="text" placeholder="Enter Username" name="login">

    <label>Email</label>
    <input type="Email" placeholder="name@email.com" name="email">

    <label>Password</label>
    <input type="text " placeholder="Enter Password" name="password">

    <button type="submit" name="submit" value="OK" onClick="return validateMe()">Login</button>
  </div>
</form>
</body>
</html>

<?php
session_start();
require 'config/database.php';
if (isset($_SESSION["login"]))
{
  
echo "you are home";
echo "<br>";
$page = 0;
$images_per_page = 3;
if (isset($_POST["page"])) 
{
  $page = $_POST["page"];
  $page = ($page * $images_per_page) - $images_per_page;
}


$stmt = $db->query("SELECT * FROM images LIMIT $page, $images_per_page");
$stmt1 = $db->query("SELECT * FROM images");
$count = $stmt1->rowCount();
$a = $count/$images_per_page;
$a = ceil($a);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  //echo htmlentities($row['firstname']);
  ?>
  <img src = "<?php echo $row['link'];?>" width = "400" height = "300"> </img>
  <?php
}

echo "<br>";
?>
<form method = "post">
<?php
for ($i=1; $i < $a; $i++) 
{ 
  ?>
  <input type="submit" value = "<?php echo $i;?>" name = "page">
  <?php
  # code...
}



}
else
header("location:index.php");
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


function myFunction(){
    var x = document.getElementById("myFile");
    upload_overlay = document.getElementById("upload_overlay");
    var txt = "";
    if ('files' in x) {
        if (x.files.length == 0) {
            txt = "Select one or more files.";
        } else {
               
                var file = x.files[0];
                if ('name' in file) {
                    txt += "name: " + file.name + "<br>";
                }
                if ('size' in file) {
                    txt += "size: " + file.size + " bytes <br>";
                }

        }
    } 
    else {
        if (x.value == "") {
            txt += "Select file.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
        }
    }
    document.getElementById("demo").innerHTML = txt;
    src = window.URL.createObjectURL(file);
upload_overlay.innerHTML = "<img class='image_overlay2' src ="+src+"></img>";
upload = String(file);
//reader.readAsBinaryString(upload);
alert(upload);
window.URL.revokeObjectURL(file);
}
