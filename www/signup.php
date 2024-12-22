<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $National_ID = $_POST['National_ID'];
    $email = $_POST['Email'];
    $Password = $_POST['Password'];

    if (!empty($National_ID) && !empty($Password)) {
        // Hash the password
        $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
        
        $stmt = $con->prepare("INSERT INTO users (National_ID	, Password, Email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $National_ID, $hashed_password, $email);
        $stmt->execute();
        $stmt->close();
        
        // Redirect to login page
        header("Location: login.php");
        die;
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
  <link rel="preconnect" href="https://fonts.gstatic.com' crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Libre+Baskerville&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
</head>
<body class="custom-body">
<div class="wrapper">
  <form method="POST" onsubmit="return signupValidate()" id="signupForm">
    <h1>Welcome to Cairo2Capital Transport</h1>
    <p class="title">Signup</p>

    <!-- First Name -->
    <div class="input-box">
      <input type="text" placeholder="First Name">
      <i class='bx bxs-user'></i> 
    </div>
    
    <!-- Last Name -->
    <div class="input-box">
      <input type="text" placeholder="Last Name">
      <i class='bx bxs-user'></i> 
    </div>

    <div class="input-box">
      <input type="number" placeholder="National ID" name='National_ID' id="nationalID" required>
      <i class='bx bxs-user'></i>    
    </div>
    <div class="input-box">
      <input type="email" placeholder="Email (Optional)" name='Email'>
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
