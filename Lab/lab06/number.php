<?php
session_start();
if (!isset($_SESSION["number"])) {
    $_SESSION["number"] = 0;
}
$num = $_SESSION["number"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title> Managing Session</title>
</head>
<body>
<h1>Web Development - Lab 06</h1>
<?php
echo "<p>The number is $num </p"
?>
<br>
<p><a href="numberup.php">Up</a></p>
<p><a href="numberdown.php">Down</a></p>
<p><a href="numberreset.php">Reset</a></p>
</body>
</html>


