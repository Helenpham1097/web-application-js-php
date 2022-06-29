<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Member Page</title>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
</head>
<body>
<?php
function test_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
$lnameError = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_GET["lname"])) {
    $lnameError = "Last Name is required";
} else {
    $lname = test_input($_GET["lname"]);
}
?>
<h1>Search Members By Last Name</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
    <label for="lname">Last Name </label>
    <input type="text" id="lname" name="lname" value=""><span class="error">* <?php echo $lnameError;?></span>
    <input type="submit" value="Show Results"><br><br>
    <a href="http://nnv5724.cmslamp14.aut.ac.nz/lab05/vip_member.php">Return to Home Page</a>
</form>

</body>
</html>
<?php
require_once("/home/nnv5724/conf/settings.php");
$tableName = 'vipmember';
$conn = @mysqli_connect($host, $user, $pswd)
or die("Fail to connect to server");
@mysqli_select_db($conn, $dbnm)
or die("Fail to connect to database");

$tableQuery = "SHOW TABLES LIKE '$tableName'";
$foundTable = mysqli_query($conn, $tableQuery);

if (empty($foundTable)) {
    $createTable = "create table vipmember
(
	member_id int auto_increment,
	fname varchar(40) not null,
	lname varchar(40) not null,
	gender varchar(1) not null,
	email varchar(40) not null,
	phone varchar(20) not null,
	constraint vipmember_pk
		primary key (member_id)
)";
    mysqli_query($conn, $createTable);
}


$sql = "SELECT (member_id, lname, fname, email)
    FROM vipmember
WHERE STATUS LIKE '$lname'";
$queryResult = @mysqli_query($conn, $sql)
or die("<h1>Unable to execute the query </h1>")
. mysqli_errno($conn) . ": " . mysqli_error($conn);

$rowcount = mysqli_num_rows($queryResult);
mysqli_close($conn);
if ($rowcount > 0){
?>
<!DOCTYPE html>
<html lang="en" http-equiv="content-type" content="text/html">
<head>
    <meta charset="UTF-8">
    <title>Web Development Lab 5 Task 2</title>
    <style>
        body {
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

        th {
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
        while ($rows = $queryResult->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['member_id']; ?></td>
                <td><?php echo $rows['fname']; ?></td>
                <td><?php echo $rows['lname']; ?></td>
                <td><?php echo $rows['email']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</section>

<?php
} else {
   echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Web Development Lab 05 </title>
</head>
<body>

        <div class='content'>
            <h2>No Member Last Name matched with the last name you entered. Please try another one </h2>
            <br>
            <a style='color: saddlebrown; font-weight:900 ' href='http://nnv5724.cmslamp14.aut.ac.nz/lab05/member_search.php'>Return to Add Member Form</a>
        </div>

</body>
</html>";
}
}
?>
