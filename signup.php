<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $CustSSN = $_POST['CustSSN'];
    $custEmail = $_POST['custEmail'];
    $Password = $_POST['Password'];

    if (!empty($CustSSN) && !empty($Password) && !empty($custEmail)) {
        $check_stmt = $con->prepare("SELECT custEmail FROM customer WHERE custEmail = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "This email is already in use. Please choose another email.";
            $check_stmt->close();
        } else {
            $check_stmt->close();
            $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
            $stmt = $con->prepare("INSERT INTO customer (first_name, last_name, CustSSN, Password, custEmail) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $first_name, $last_name, $CustSSN, $hashed_password, $custEmail);
            $stmt->execute();
            $stmt->close();
            
            header("Location: login.php");
            die;
        }
    } else {
        echo "Please enter valid information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="login-signup.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Libre+Baskerville&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
</head>
<body class="custom-body">
<div class="wrapper">
  <form method="POST" onsubmit="return signupValidate()" id="signupForm">
    <h1>Welcome to Cairo2Capital Transport</h1>
    <p class="title">Signup</p>

    <div class="input-box">
      <input type="text" placeholder="First Name" name="first_name">
      <i class='bx bxs-user'></i> 
    </div>
    
    <div class="input-box">
      <input type="text" placeholder="Last Name" name="last_name">
      <i class='bx bxs-user'></i> 
    </div>

    <div class="input-box">
      <input type="number" placeholder="National ID" name='CustSSN' id="nationalID" required>
      <i class='bx bxs-user'></i>    
    </div>
    <div class="input-box">
      <input type="email" placeholder="Email (Optional)" name='custEmail'>
      <i class='bx bxs-envelope'></i>    
    </div>
    <div class="input-box">
      <input type="password" placeholder="Password" id="password" name='Password' required>
      <i class='bx bxs-lock-alt'></i>
    </div>
    <div class="input-box">
      <input type="password" placeholder="Repeat password" id="confirm-password" required>
      <i class='bx bxs-lock-alt'></i>
    </div>
    <button type="submit" class="btn">Signup</button>
    <div class="login-link">
      <p>Already have an account? <a href="./login.php">Login</a></p>
    </div>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./login-signup.js"></script>
</body>
</html>
