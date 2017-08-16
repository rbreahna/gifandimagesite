<?php
include "TextEditor.php";

$test = new TextEditor;

$test->setText(1, "Hello, my name is Eugen");

echo $test->getText(1);
echo"<br>";
echo $test->getText(2);
echo"<br>";
echo $test->getText(3);

$test->setText(1, "Goodbye");
echo"<br>";
echo $test->getText(1);
echo"<br>";

?>