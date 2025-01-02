<?php
session_start();
include("connection.php");

if (!isset($_SESSION['National_ID'])) {
    header("Location: login.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nationalId = $_SESSION['National_ID'];
    $firstName = $_POST['First_Name'];
    $lastName = $_POST['Last_Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET Password = '$hashed_password' WHERE National_ID = '$nationalId'";
    }

    if (!empty($email)) {
        $query = "UPDATE users SET Email = '$email',  WHERE National_ID = '$nationalId'";
    }

    if(!empty($nationalId)){
        $query = "UPDATE users SET National_ID = '$nationalId' WHERE National_ID = '$nationalId'";
    }

    if (!empty($firstName)){
        $query = "UPDATE users SET First_Name = '$firstName' WHERE National_ID = '$nationalId'";
    }

    if (!empty($lastName)){
        $query = "UPDATE users SET Last_Name = '$lastName' WHERE National_ID = '$nationalId'";
    }

        $result = mysqli_query($con, $query);
        if ($result) {
            echo "Details updated successfully";
        } else {
            echo "Failed to update details. Please try again.";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0px;
            padding: 0px;
            font-weight: 500;
        }
    </style>
<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="login.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="./pictures/logo c2c.png" alt="" height="100px" width="230px">
                <span class="fs-4">Cairo2Capital Transport</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="./stations.php" class="nav-link text-success">Home</a></li>
                <li class="nav-item"><a href="./lines.html" class="nav-link text-success">Lines</a></li>
                <li class="nav-item"><a href="./FAQs.html" class="nav-link text-success">FAQs</a></li>
                <li class="nav-item"><a href="./about.html" class="nav-link text-success">About</a></li>
                <li class="nav-item"><a href="./edit_user.php" class="nav-link active bg-success text-white">Account</a></li>
            </ul>
        </header>
    </div>
    <div class="container">
        <h2>Edit User Details</h2>
        <form method="post" action="edit_user.php">
            <div class="form-group">
                <label for="First_Name">First Name (Leave blank if you don't want to change it):</label>
                <input type="text" id="First_Name" name="First_Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="Last_Name">Last Name (Leave blank if you don't want to change it):</label>
                <input type="text" id="Last_Name" name="Last_Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="Email">Email (Leave blank if you don't want to change it):</label>
                <input type="email" id="Email" name="Email" class="form-control">
            </div>
            <div class="form-group">
                <label for="Password">Password (Leave blank if you don't want to change it):</label>
                <input type="password" id="Password" name="Password" class="form-control">
            </div>
            <div class="form-group">
                <label for="National_ID">National ID (Leave blank if you don't want to change it):</label>
                <input type="text" id="National_ID" name="National_ID" class="form-control">
            </div>
            <br>
            <button type="submit" class="btn btn-success">Update Details</button>
        </form>
    </div>
</body>
</html>