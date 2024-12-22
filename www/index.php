<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);
header("Location: login.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title> my webpage</title>
    </head>
    <body>
        <a href="logout.php">logout</a>
        <h1>this is the index page</h1>
        <br>
        hello,Username.
</body>
</html>