<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>Lab 2 - Task 4</title>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
</head>
<body>
<h1> Check leap year</h1>
<?php
$var = $_GET["year"];
if (is_numeric($var)) {
    if ((0 == $var % 4) & (0 != $var % 100) | (0 == $var % 400)) {
        echo "The year you entered " . $var . " is a leap year";
    } else {
        echo "The year you entered " . $var . " is a standard year";
    }
} else {
    echo "Please enter a number";
}
function isLeapYear($year)
{
    if (is_numeric($year)) {
        if ((0 == $year % 4) & (0 != $year % 100) | (0 == $year % 400)) {
            return true;
        }
    }
    return false;
}

$is_leap = isLeapYear((int) $_GET["year"]);
if($is_leap == 1){
    echo "</br>True";
}else{
    echo "</br>False";
}
?>

</body>
</html>