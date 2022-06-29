<?php
/**
 * Helen Pham
 * Student ID 21133245
 * This booking.php is used to connect to the database and close when it finishes the invoked function. Decode json format from the post request in booking.js file to get values
 * insert to database and return confirmation to the booking.js file, and then booking.js will generate code depended on the information this php file return
 * do recursion when creating booking number if the new number is repetitive
 */
require_once("/home/nnv5724/conf/sqlinfo.inc.php");
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$customerName = $data["cname"];
$phoneNumber = $data["phone"];
$unitNumber = $data['unumber'];
$streetNumber = $data["snumber"];
$streetName = $data["stname"];
$suburb = $data["sbname"];
$destinationSuburb = $data["dsbname"];
$pickUpDate = $data["date"];
$pickUpTime = $data["time"];

if ($customerName != null && $phoneNumber != null && $streetNumber != null && $streetName != null && $pickUpDate != null && $pickUpTime != null) {
    $tableName = 'booking';
    $conn = @mysqli_connect($sql_host, $sql_user, $sql_pass)
    or die("Fail to connect to server");
    @mysqli_select_db($conn, $sql_db)
    or die("Fail to connect to database");

 //check table existed
    $tableQuery = "SHOW TABLES LIKE '$tableName'";
    $foundTable = mysqli_query($conn, $tableQuery);
    $tableResult =  $foundTable->fetch_row();
    if (empty($tableResult)) {
        $createTable = "create table booking
(
	booking_id int auto_increment,
	booking_number varchar(8) not null unique,
	customer_name varchar(50) not null,
	phone_number varchar(12) not null,
	unit_number varchar(10) null,
	street_number varchar(10) not null,
	street_name varchar(50) not null,
	suburb varchar(50) null,
	destination_suburb varchar(50) null,
	pickup_date date not null,
	pickup_time time not null,
	booking_date_time datetime not null,
	status varchar(10) not null,
	constraint booking_pk
		primary key (booking_id)
)";
        mysqli_query($conn, $createTable);
    }

 //create and check booking number. If new booking number is repetitive, then do recursion to create the unique booking number
    function createBookingNumber($conn)
    {
        $rand = rand(0, 99999);
        $bookingNumber = "BRN" . str_pad($rand, 5, '0', STR_PAD_LEFT);
        $bookingReferenceSql = "Select booking_number from booking where booking_number = '$bookingNumber'";
        $duplicatedBooking = mysqli_query($conn, $bookingReferenceSql);
        $row = $duplicatedBooking->fetch_row();
        if (!empty($row)) {
            createBookingNumber($conn);
        } else {
            return $bookingNumber;
        }
    }

    $bookingReference = createBookingNumber($conn);
    $bookingDateTime = date('Y-m-d h:i:s');
    $status = "unassigned";
    $addBookingSql = "INSERT INTO booking(
                    booking_number,
                    customer_name,
                    phone_number,
                    unit_number,
                    street_number,
                    street_name,
                    suburb,
                    destination_suburb,
                    pickup_date,
                    pickup_time,
                    booking_date_time,
                    status) 
                    VALUES (
                            '$bookingReference',
                            '$customerName',
                            '$phoneNumber',
                            '$unitNumber',
                            '$streetNumber',
                            '$streetName',
                            '$suburb',
                            '$destinationSuburb',
                            '$pickUpDate',
                            '$pickUpTime',
                            '$bookingDateTime',
                            '$status')";

    if (mysqli_query($conn, $addBookingSql)) {
        echo json_encode(array("bookingReference" => $bookingReference));
    } else {
        echo "Cannot add booking";
    }
    mysqli_close($conn);
} else {
    echo json_encode(array("bookingReference" => "error"));
}

