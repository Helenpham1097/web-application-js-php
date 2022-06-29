<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Using string functions</title>
</head>
<body>
<h1>Web Development – Lab 3</h1>
<?php
if (isset($_POST["input"])) {
    $inputString = $_POST["input"];
    $pattern = "/^[A-Za-z ]+$/";
    if (preg_match($pattern, $inputString) == 1) {
        $answer = '';
        $length = strlen($inputString);
        for ($i = 0; $i < $length; $i++) {
            $letter = substr($inputString, $i, 1);
            if (!is_numeric(strpos("AEIOUaeiou", $letter))) {
                $answer = $answer . $letter;
            }
        }
        echo "<p>The word with no vowels is ", $answer, ".</p>";
    } else {
        echo "<p>Please enter a string containing only letters or space</p>";
    }
} else {
    echo "<p>Please enter a string from input form.</p>";
}
?>
</body>
</html>