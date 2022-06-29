
<?php

require_once ("/home/nnv5724/conf/settings.php");

$conn = @mysqli_connect($host, $user, $pswd)
or die("Fail to connect to server");
@mysqli_select_db($conn, $dbnm)
or die("Database are not available");
$query = "SELECT * FROM car";
$results = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en" http-equiv="content-type" content="text/html">
<head>
    <meta charset="UTF-8">
    <title>Using file functions</title>
    <style>
        body{
            background-color: lightpink;
        }
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }

        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }

        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }

        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            font-weight: lighter;
        }
    </style>
</head>

<body>
<section>
    <h1>Web Development - Lab 05</h1>
    <table>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Price</th>
            <th>Year of Manufacture</th>
        </tr>
        <?php
        while ($rows = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['make']; ?></td>
                <td><?php echo $rows['model']; ?></td>
                <td><?php echo '$' . $rows['price']; ?></td>
                <td><?php echo $rows['yom']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</section>
