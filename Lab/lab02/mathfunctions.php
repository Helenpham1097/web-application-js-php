<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>Lab 2 - Task 3</title>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8"/>
</head>
<body>
<?php
function factorial($number){
    $result = 1;
    $factor = $number;
    if ($number == 1 || $number == 0){
        return 1;
    }
    while ($factor>1){
        $result = $result * $factor;
        $factor--;
    }
    return $result;
}
?>
</body>
</html>
