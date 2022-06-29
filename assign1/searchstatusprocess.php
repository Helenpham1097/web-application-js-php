<?php
require_once ("/home/nnv5724/conf/sqlinfo.inc.php");
$status = $_GET['search'];
$emptyStatus = str_replace(" ", "", $status);
if (empty($status)||empty($emptyStatus)) {
echo "<!DOCTYPE html>
<html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Car Details</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
        <section id='add-status'>
            <div class='store container'>
                <div class='content'>
                    <h2>The search string is empty. Please enter a key word to search</h2>
                    <br>
                     <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/index.html'><strong style='color: saddlebrown'>Return to Home Page</strong></a>
                    <br>
                    <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/searchstatusform.html'><strong style='color: saddlebrown'>Return to Search Status Page</strong></a>
   
                </div>
            </div>
        </section>
        </body>
        </html>";
} else {
    $conn = @mysqli_connect($sql_host, $sql_user, $sql_pass)
    or die("Fail to connect to server");
    @mysqli_select_db($conn, $sql_db)
    or die("Fail to connect to database");
    $tableName = 'assignment1';

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
        mysqli_query($conn, $createTable);
    }
    ;
    $searchValue = strtolower($status);
    $sql = "SELECT *
    FROM assignment1
WHERE STATUS LIKE '%$status%'";
    $results = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($results);
    mysqli_close($conn);
    if ($rowcount > 0) {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Car Details</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
        <section id="add-status">
        <div class="store container">
        <div class="content">
        <h1>Query All Matched Status</h1>
            <br>
        <table id="status_query">
            <tr>
                <th>Status Code</th>
                <th>Status</th>
                <th>Share</th>
                <th>Date</th>
                <th>Permission</th>
            </tr>
            <?php
            while ($row = $results->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['status_code']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['share']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['permission']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
            <br>
        <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/index.html'><strong
                    style='color: saddlebrown'>Return to Home Page</strong></a>
        <br>
        <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/searchstatusform.html'><strong
                    style='color: saddlebrown'>Search for another status</strong></a>
    </div>
    </div>
</section>
</body>
    </html>
    <?php
} else {
    echo "<!DOCTYPE html>
<html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Car Details</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
        <section id='add-status'>
            <div class='store container'>
                <div class='content'>
                    <h2>Status not found. Please try a different keyword</h2>
                    <br>
                     <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/index.html'><strong style='color: saddlebrown'>Return to Home Page</strong></a>
                    <br>
                    <a href='http://nnv5724.cmslamp14.aut.ac.nz/assign1/searchstatusform.html'><strong style='color: saddlebrown'>Return to Search Status Page</strong></a>
   
                </div>
            </div>
        </section>
        </body>
        </html>";
}
}

