<?php
require_once ("/home/nnv5724/conf/settings.php");
if (!empty($_POST)) {
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

    function test_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    $lname = test_input($_POST['lname']);
    $fname = test_input($_POST['fname']);
    $gender = test_input($_POST['gender']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);

    //check for duplicate status_code
    $sql = "INSERT INTO vipmember (lname, fname, gender, email, phone) VALUES ('$lname','$fname', '$gender','$email','$phone')";
    $queryResult = @mysqli_query($conn, $sql)
    or die("<h1>Unable to execute the query </h1>")
    . mysqli_errno($conn) . ": " . mysqli_error($conn);
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Web Development Lab 05 </title>
</head>
<body>

        <div class='content'>
            <h2>Congratulations! Member has been successfully added</h2>
            <br>
            <a style='color: saddlebrown; font-weight:900 ' href='http://nnv5724.cmslamp14.aut.ac.nz/lab05/vipmember.php'>Return to Home Page</a>
        </div>

</body>
</html>";
    mysqli_close($conn);

}else{
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Web Development Lab 05 </title>
</head>
<body>

        <div class='content'>
            <h2>You must enterred all detail information </h2>
            <br>
            <a style='color: saddlebrown; font-weight:900 ' href='http://nnv5724.cmslamp14.aut.ac.nz/lab05/member_add_form.php'>Return to Add Member Form</a>
        </div>

</body>
</html>";
}






