<?php
session_start();
include("connection.php");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $National_ID = $_POST['National_ID'];
    $Password = $_POST['Password'];

    if (!empty($National_ID) && !empty($Password)) {
        // Prepare the SQL statement to prevent SQL injection
        $query = "SELECT * FROM users WHERE National_ID = ? LIMIT 1";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $National_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($Password, $user_data['Password'])) {
                $_SESSION['National_ID'] = $user_data['National_ID'];
                // Ensure there is no output before header
                header("Location: stations.php");
                die;
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No user found with that National ID";
        }
        
        $stmt->close();
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
  <title>Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="login-signup.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Libre+Baskerville&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
</head>
<body class="custom-body">
<div class="wrapper">
  <form method="post" onsubmit="return loginValidate()" action="" id="loginForm">
    <h1>Welcome to Cairo2Capital Transport</h1>
    <p class="title">Login</p>
    
    <!-- National ID -->
    <div class="input-box">
      <input type="number" placeholder="National ID" name='National_ID' id="nationalID" required>
      <i class='bx bxs-user'></i>    
    </div>

    <!-- Password -->
    <div class="input-box">
      <input type="password" placeholder="Password" name='Password' id="password" required>
      <i class='bx bxs-lock-alt'></i>
    </div>

    <button type="submit" class="btn">Login</button>
    <div class="login-link">
      <p>Don't have an account? <a href="./signup.php">Signup</a></p>
    </div>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./login-signup.js"></script>
</body>
</html>
