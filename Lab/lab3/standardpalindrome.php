<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Using string functions</title>
</head>
<body>
<h1>Lab 3 - Task 3 - Standard Palindrome </h1>
<?php
$input = $_POST["input"];

if(!empty($input) && !is_numeric($input)){
    $word = strtoupper(preg_replace('/[\W]/', '', $input));
    $reverseWord = strrev($word);
    if(strcmp($word,$reverseWord)==0){
        echo "<p>The string ".$input." you entered is a perfect palindrome</p>";
    }else{
        echo "<p>The string ".$input." you entered is not perfect palindrome</p>";
    }
}elseif (!empty($input) && is_numeric($input)){
    echo "<p>Please enter a string not a number</p>";
}else{
    echo "<p>Please enter a string from input form.</p>";
}
?>
</body>
