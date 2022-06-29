<?php


$sql_host = "cmslamp14.aut.ac.nz";
$sql_user = "nnv5724";
$sql_pass = "ThTr10030810";
$sql_db = "nnv5724";

$conn = @mysqli_connect($sql_host, $sql_user, $sql_pass)
or die("Fail to connect to server");
@mysqli_select_db($conn, $sql_db)
or die("Database are not available");
$query1 = "SELECT * FROM car";
$results1 = mysqli_query($conn, $query1);

$query2 = "SELECT make,model,price FROM car
ORDER BY make ASC, model ASC";
$results2 = mysqli_query($conn, $query2);

$query3 = "Select * from car where price >=20000";
$results3 = mysqli_query($conn, $query3);

$query4 = "Select * from car where price <15000";
$results4 = mysqli_query($conn, $query4);

$query5 = "SELECT AVG( price )FROM car
WHERE make = 'Ford'";
$results5 = mysqli_query($conn, $query5);

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Details</title>
    <style>
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
    <h1>Query All Car Details</h1>
    <table>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Price</th>
            <th>Year of Manufacture</th>
        </tr>
        <?php
        while ($rows = $results1->fetch_assoc()) {
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
<section>
    <h1>Query make, model and price sorted by make and model</h1>
    <table>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Price</th>
        </tr>
        <?php
        while ($rows = $results2->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['make']; ?></td>
                <td><?php echo $rows['model']; ?></td>
                <td><?php echo '$' . $rows['price']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</section>
<section>
    <h1>Query All Car Details which has price over $20000</h1>
    <table>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Price</th>
            <th>Year of Manufacture</th>
        </tr>
        <?php
        while ($rows = $results3->fetch_assoc()) {
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

<section>
    <h1>Query All Car Details which has price below $15000</h1>
    <table>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Price</th>
            <th>Year of Manufacture</th>
        </tr>
        <?php
        while ($rows = $results4->fetch_assoc()) {
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

<section>
    <h1>Get Average price of cars for the same model : FORD</h1>
    <?php
    while ($rows = $results5->fetch_assoc()) {
        echo"<h2 style='text-align: center'>The Average Price is ".$rows['AVG( price )']."</h2>";
    }
    ?>

</section>


</body>

</html>



