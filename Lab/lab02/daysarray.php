<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>Lab 2 - Task 1</title>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
</head>
<body>

<?php
$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
$arrlength = count($days);
echo"<p>The days of the week in English are: </p>";
for($x = 0; $x < $arrlength; $x++) {
    echo $days[$x];
    echo ", ";
}

$days2 = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
array_replace($days,$days2);
echo"<p>The days of the week in French are: </p>";
for($x = 0; $x < $arrlength; $x++) {
    echo $days2[$x];
    echo ", ";
}
?>
</body>
</html>