
<?php

require_once ("/home/nnv5724/conf/settings.php");

$conn = @mysqli_connect($host, $user, $pswd)
or die("Fail to connect to server");
@mysqli_select_db($conn, $dbnm)
or die("Database are not available");
$query = "SELECT (member_id, fname, lname) FROM vipmember";
$results = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en" http-equiv="content-type" content="text/html">
<head>
    <meta charset="UTF-8">
    <title>Web Development Lab 5 Task 2</title>
    <style>
        body{
            background-color: cornsilk;
        }
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }

        h1 {
            text-align: center;
            color: lightcoral;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }

        th{
            background-color: darksalmon;
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            background-color: pink;
            border: 1px solid black;
        }

        td {
            font-weight: lighter;
        }
    </style>
</head>

<body>
<section>
    <h1>All Members Detail Information</h1>
    <table>
        <tr>
            <th>Member Id</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php
        while ($rows = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['member_id']; ?></td>
                <td><?php echo $rows['fname']; ?></td>
                <td><?php echo $rows['lname']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</section>
