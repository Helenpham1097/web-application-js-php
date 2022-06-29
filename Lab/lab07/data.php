<?php
require_once("/home/nnv5724/conf/sqlinfo.inc.php");

//decode data from json format
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$name = $data['user_name'];
$pwd = $data['password'];

//connect to database
$tableName = 'lab07';
$conn = @mysqli_connect($sql_host, $sql_user, $sql_pass)
or die("Fail to connect to server");
@mysqli_select_db($conn, $sql_db)
or die("Fail to connect to database");

//check table if existed
$tableQuery = "SHOW TABLES LIKE '$tableName'";
$foundTable = mysqli_query($conn, $tableQuery);
if (empty($foundTable)) {
    $createTable = "create table lab07 
                            (   user_name varchar(50) not null unique,
                                password varchar(50) not null,
	                            email varchar(50) not null,
	                            constraint lab07_pk
		                            primary key (user_name))";
    mysqli_query($conn, $createTable);
}

//get information
$queryInfoByName = "SELECT *
                        FROM `lab07`
                            WHERE user_name = '$name'";
$result = mysqli_query($conn, $queryInfoByName);

//check result and return value
if($result) {
    if ($result['password'] == $pwd) {
        echo json_encode(array("email" => $result['email']));
    } else {
        echo json_encode(array("email" => "null"));
    }
}
// close connection
mysqli_close($conn);


