<?php
/**
 *Student Name: Helen Pham
 * Student ID: 21133245
 * connect to the database, query the information of bookings based on the value of the bsearch button.
 * if the input is empty, the server will query the booking in 2 hours from now.
 * If the input contains booking number, it will query only this booking and send to the js file.
 * when it receives the input containing information of booking need to be assigned, it will update the database and return the information for the js file to handle and render to admin.html page
 */
date_default_timezone_set("Pacific/Auckland");
require_once("/home/nnv5724/conf/sqlinfo.inc.php");
$conn = @mysqli_connect($sql_host, $sql_user, $sql_pass)
or die("Fail to connect to server");
@mysqli_select_db($conn, $sql_db)
or die("Fail to connect to database");

//search booking
if (isset($_GET["bsearch"])) {
    $bookingReference = $_GET["bsearch"];
    $tableName = 'booking';
    $tableQuery = "SHOW TABLES LIKE '$tableName'";
    $foundTable = mysqli_query($conn, $tableQuery);

    //check table is empty, if empty, create table
    if (empty($foundTable)) {
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
                            primary key (booking_id))";
        mysqli_query($conn, $createTable);
    }

    //if booking reference is null
    if ($bookingReference == null) {
        $startTime = date("H:i:s");
        $endTime = date("H:i:s", strtotime("+2 hour"));

        $sql = "SELECT booking_number, customer_name, phone_number, suburb, destination_suburb, pickup_date, pickup_time, status
                    FROM booking
                    WHERE (pickup_time
                    BETWEEN '" . $startTime . "' AND '" . $endTime . "')AND (status LIKE 'unassigned')";

        if (mysqli_query($conn, $sql)) {
            $results = mysqli_query($conn, $sql);
            $return = array();
            while ($rows = $results->fetch_assoc()) {
                $bookingReference = $rows['booking_number'];
                $customerName = $rows['customer_name'];
                $customerPhone = $rows['phone_number'];
                $suburb = $rows['suburb'];
                $destinationSuburb = $rows['destination_suburb'];
                $pickUpDate = $rows['pickup_date'];
                $pickUpTime = $rows['pickup_time'];
                $status = $rows['status'];
                $return[] = array('bookingReference' => $bookingReference, 'customerName' => $customerName, 'customerPhone' => $customerPhone, 'suburb' => $suburb,
                    'destinationSuburb' => $destinationSuburb, 'pickUpDate' => $pickUpDate, 'pickUpTime' => $pickUpTime, 'status' => $status);

            }
            echo json_encode($return);
        }else{
            echo "No booking in this range";
        }

        // if booking number is not null
    } else {
        $sql = "SELECT booking_number, customer_name, phone_number, suburb, destination_suburb, pickup_date, pickup_time, status
                    FROM booking
                    WHERE booking_number = '$bookingReference'";
        if (mysqli_query($conn, $sql)) {
            $results = mysqli_query($conn, $sql);
            $return = array();
            $rows = $results->fetch_assoc();
            $bookingReference = $rows['booking_number'];
            $customerName = $rows['customer_name'];
            $customerPhone = $rows['phone_number'];
            $suburb = $rows['suburb'];
            $destinationSuburb = $rows['destination_suburb'];
            $pickUpDate = $rows['pickup_date'];
            $pickUpTime = $rows['pickup_time'];
            $status = $rows['status'];
            $return[] = array('bookingReference' => $bookingReference, 'customerName' => $customerName, 'customerPhone' => $customerPhone, 'suburb' => $suburb,
                'destinationSuburb' => $destinationSuburb, 'pickUpDate' => $pickUpDate, 'pickUpTime' => $pickUpTime, 'status' => $status);
            echo json_encode($return);
        }else{
            echo "Booking number is not valid";
        }
    }
    mysqli_close($conn);
}

// assign booking
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($data != null) {
    $bookingNumber = $data['bookingReference'];
    $sql = "UPDATE booking
                        SET 
                        status = 'Assigned'
                        WHERE
                        booking_number ='$bookingNumber'";
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT booking_number, customer_name, phone_number, suburb, destination_suburb, pickup_date, pickup_time, status
                    FROM booking
                    WHERE booking_number = '$bookingNumber'";
        if (mysqli_query($conn, $sql)) {
            $results = mysqli_query($conn, $sql);
            $return = array();
            $rows = $results->fetch_assoc();
            $bookingReference = $rows['booking_number'];
            $customerName = $rows['customer_name'];
            $customerPhone = $rows['phone_number'];
            $suburb = $rows['suburb'];
            $destinationSuburb = $rows['destination_suburb'];
            $pickUpDate = $rows['pickup_date'];
            $pickUpTime = $rows['pickup_time'];
            $status = $rows['status'];
            $return[] = array('bookingReference' => $bookingReference, 'customerName' => $customerName, 'customerPhone' => $customerPhone, 'suburb' => $suburb,
                'destinationSuburb' => $destinationSuburb, 'pickUpDate' => $pickUpDate, 'pickUpTime' => $pickUpTime, 'status' => $status);
            echo json_encode($return);
        }
    }
    mysqli_close($conn);
}
