
<!DOCTYPE>
<html lang="en">
<head>
    <title> Managing Session</title>
</head>
<body>
<h1>Guessing Game</h1>
<?php
session_start();
$guessedNumber = $_SESSION["hiddenNumber"];
echo "<p>The hidden number was: $guessedNumber</p>"
?>
<p><a href="startover.php"></a>Start Over</p>
</body>
</html>