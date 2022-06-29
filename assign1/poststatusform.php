<?php
date_default_timezone_set('Pacific/Auckland');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment1-Helen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="add-status">
    <div class="store container">
        <div class="filter">
            <h1>Status Posting System</h1>
            <form action="poststatusprocess.php" method="post">
                <label for="statuscode">Status Code <span class="error">(required)</span></label><br>
                <input type="text" id="statuscode" name="statuscode" value=""><br><br>
                <label for="status">Status <span class="error">(required)</span></label><br>
                <input type="text" id="status" name="status" value=""><br><br>
                Share:
                <input type="radio" name="share" value="public">Public
                <input type="radio" name="share" value="friends">Friends
                <input type="radio" name="share" value="only me">Only me<br><br>

                <label for="date">Date <span class="error">(required)</span></label><br>
                <input type="date" id="date" name="date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" ><br><br>
                Permission type:
                <input type="checkbox" name="permission[]" value="allow like">Allow Like
                <input type="checkbox" name="permission[]" value="allow comments">Allow Comments
                <input type="checkbox" name="permission[]" value="allow share">Allow Share<br><br>
                <input type="submit" value="Post">
                <br>
                <input type="reset" value="Reset">
                <br>
                <a href="http://nnv5724.cmslamp14.aut.ac.nz/assign1/index.html"><strong style="color: brown" >Return to Main Page</strong></a>
            </form>
        </div>
    </div>
</section>
</body>
</html>
