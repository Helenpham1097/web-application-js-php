<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>PHP Functions</title>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
</head>
<body>
<h1>Use of PHP built-in functions</h1>
<?php
// calculate the total of the array number using array_sum
echo "<p> The total of the array numbers [1,2,3,4,5] is: ";
$a = array(10,38,12);
echo array_sum($a);
?>
<?php
// use of decbin() and bindec() functions
echo "<p> Decimal equivalent of 1101 is: ", bindec(1101),".</p>";
echo "<p> Binary equivalent of 14 is: ", decbin(14), ".</p>";
?>
</body>
</html>
