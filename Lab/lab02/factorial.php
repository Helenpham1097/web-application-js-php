<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>Lab 2 - Task 2</title>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
</head>
<body>
<h1> Check even number</h1>
<?php
$var =  $_GET["number"];
(filter_var($var, FILTER_VALIDATE_INT) && ((int)$var %2 == 0))
    ? $output = "The is an even!"
    : $output = "Please enter an even";
echo "<p>", $output , "</p>";
?>
</body>
</html>
