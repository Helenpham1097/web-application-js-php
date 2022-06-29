<?php
session_start();
if (!isset($_SESSION["number"])) {
    $_SESSION["number"] = 0;
}
$number = $_SESSION["number"];
?>
<!DOCTYPE>
<html lang="en">
<head>
    <title> Managing Session</title>
</head>
<body>
<h1>Guessing Game</h1>
<p>Enter the number between 1 and 100, then press the Guess Button</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" value="" name="number">
    <input type="submit" value="Guess">
</form>
<br>
<?php
$hiddenNumber = rand(0, 100);
$guessedNumber = $_POST['number'];
if (is_numeric($guessedNumber) && ($guessedNumber >= 0 && $guessedNumber <= 100)) {
    $number++;
    if ($hiddenNumber == $guessedNumber) {
        echo "<p>Congratulations! You guessed the hidden number</p>";
    }
    echo "<p>Number of guesses is $number</p>";
} else {
    echo "<p>Please enter a number in the range</p>";
}
?>
<p><a href="giveup.php">Give up</a></p>
<p><a href="startover.php">Start Over</a></p>
</body>
</html>
