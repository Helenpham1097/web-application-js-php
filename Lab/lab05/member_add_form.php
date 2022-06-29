<?php
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <title>Member Add Form</title>
    </head>
</head>
<body>
<h1>Add new member</h1>
<form action="member_add.php" method="post">
    <label for="fname">First Name </label>
    <input type="text" id="fname" name="fname" value=""><br><br>
    <label for="lname">Last Name <span class="error">(required)</span></label>
    <input type="text" id="lname" name="lname" value=""><br><br>
    Gender:
    <input type="radio" name="share" value="F">Female
    <input type="radio" name="share" value="M">Male

    <label for="email">Email </label>
    <input type="text" id="email" name="email" value=""><br><br>
    <label for="phone">Phone Number </label>
    <input type="text" id="phone" name="phone" value=""><br><br>
    <input type="submit" value="Add Member">
    <input type="reset" value="Reset">
    <a href="vip_member.php">Return to Home Page</a>
</form>
</body>
</html>