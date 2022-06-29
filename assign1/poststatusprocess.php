<?php
require_once ("/home/nnv5724/conf/sqlinfo.inc.php");
if (!empty($_POST)) {
    $statusCodeDuplicateErr = $statusCodeEmptyErr = $statusCodePatternErr = $statusErr = $dateEmptyErr = $dateValidErr = $statusEmptyErr = null;
    $statusCode = $_POST['statuscode'];
    $status = $_POST['status'];
    $share = $_POST['share'];
    $date = $_POST['date'];
    $permission = $_POST['permission'];
    $permissions = implode(', ', $permission);
    $tableName = 'assignment1';

    $conn = @mysqli_connect($sql_host, $sql_user, $sql_pass)
    or die("Fail to connect to server");
    @mysqli_select_db($conn, $sql_db)
    or die("Fail to connect to database");

    $tableQuery = "SHOW TABLES LIKE '$tableName'";
    $foundTable = mysqli_query($conn, $tableQuery);
    if (empty($foundTable)) {
        $createTable = "create table assignment1
(
	id int auto_increment,
	status_code varchar(5) not null unique,
	status varchar(100) not null,
	share varchar(10) null,
	date date not null,
	permission varchar(50) null,
	constraint assignment1_pk
		primary key (id)
)";
        mysqli_query($conn, $createTable) ;
    }

    $sql = "SELECT status_code FROM assignment1 where status_code = '$statusCode'";
    $results = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($results);

    mysqli_close($conn);

    if ($rowcount > 0) {
        $statusCodeDuplicateErr = "The status code already exists in the database. It must be unique. Please try another one";
    }

    if (empty($statusCode)) {
        $statusCodeEmptyErr = "The Status Code is mandatory";
    }

    $statusCodePattern = "/^S[0-9]{4}/";
    if (preg_match($statusCodePattern, $statusCode) == 0) {
        $statusCodePatternErr = "Wrong format! The status code must start with an 'S' followed by four digits, like 'S1010'";
    }

    $statusPattern = "/^[a-zA-Z0-9\s.,!?]*$/";
    if (preg_match($statusPattern, $status) != 1) {
        $statusErr = "Your status is in wrong format! The status only contains alphanumerical and spaces, comma, period, exclamation point and question mark";
    }

    $emptyStatus = str_replace(" ", "", $status);
    if (empty($emptyStatus)) {
        $statusEmptyErr = "Status cannot be empty or contains only space";
    }

    if (empty($date)) {
        $dateEmptyErr = "Date is required";
    }

    list($year, $month, $day) = explode('-', $date);
    $bool = checkdate($month, $day, $year);
    if (!$bool) {
        $dateValidErr = "Given day is not valid";
    }
    if ($statusCodeDuplicateErr != null || $statusCodeEmptyErr != null || $statusCodePatternErr != null || $statusErr != null || $dateEmptyErr != null || $dateValidErr != null || $statusEmptyErr != null) {
        echo "  <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Assignment1-Helen</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<section id='add-status'>
    <div class='store container'>
        <div class='content'>
            <h1>Errors After Validating Input Form </h1>
            <br>
            <p>$statusCodeDuplicateErr</p>
            <p>$statusCodeEmptyErr</p>
            <p>$statusCodePatternErr</p>
            <p>$statusErr</p>
            <p>$statusEmptyErr</p>
            <p>$dateEmptyErr</p>
            <p>$dateValidErr</p>
            <br>
            <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/poststatusform.php'>Post a new status</a>
            <br>
            <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/index.html'>Return to Home Page</a>
        </div>
    </div>
</section>
</body>
</html>";
    }
    if ($statusCodeDuplicateErr == null && $statusCodeEmptyErr == null && $statusCodePatternErr == null && $statusErr == null && $dateEmptyErr == null && $dateValidErr == null) {
        $conn2 = @mysqli_connect($sql_host, $sql_user, $sql_pass)
        or die("Fail to connect to server");
        @mysqli_select_db($conn2, $sql_db)
        or die("Fail to connect to database");
        $insertString = "INSERT INTO assignment1 (status_code, status, share, date, permission) VALUES ('$statusCode','$status', '$share','$date','$permissions')";
        $queryResult = @mysqli_query($conn2, $insertString)
        or die("<h1>Unable to execute the query </h1>")
        . mysqli_errno($conn2) . ": " . mysqli_error($conn2);
        echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Assignment1-Helen</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<section id='add-status'>
    <div class='store container'>
        <div class='content'>
            <h2>Congratulations! The status has been posted </h2>
            <br>
            <a style='color: saddlebrown; font-weight:900 ' href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/index.html'>Return to Home Page</a>
        </div>
    </div>
</section>
</body>
</html>";
        mysqli_close($conn2);
    }
}




