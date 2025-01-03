<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "trip";
include("functions.php");
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startLocation = $_POST["plan-from"];
    $endLocation = $_POST["plan-to"];
    $schedule = $_POST["date"];
    $ticketID = generateRandomNumber(4);

    $sqlInsert = "INSERT INTO ticket (startLocation, endLocation, schedule, ticketID) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->bind_param("ssss", $startLocation, $endLocation, $schedule, $ticketID);

    if ($stmt->execute()) {
        $_SESSION['ticketID'] = $ticketID;
        header("Location: ticket_details.php");
        exit();
    } else {
        echo "Failed to plan trip. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stations</title>
    <link rel="stylesheet" href="./stations.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="login.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="./pictures/logo c2c.png" alt="" height="100px" width="230px">
                <span class="fs-4">Cairo2Capital Transport</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="./stations.php" class="nav-link active bg-success text-white">Home</a></li>
                <li class="nav-item"><a href="./lines.html" class="nav-link text-success">Lines</a></li>
                <li class="nav-item"><a href="./FAQs.html" class="nav-link text-success">FAQs</a></li>
                <li class="nav-item"><a href="./about.html" class="nav-link text-success">About</a></li>
                <li class="nav-item"><a href="./edit_user.php" class="nav-link text-success">Account</a></li>
            </ul>
        </header>
    </div>
    <div class="plan-container">
        <div class="pic"></div>
        <div class="trip-plan">
            <div class="plan-h2">
                <h2>Plan a Trip</h2>
                <div class="line"></div>
            </div>
            <form action="stations.php" method="post">
                <input type="text" name="plan-from" placeholder=" From" class="from-box" required>
                <input type="text" name="plan-to" placeholder=" To" class="to-box" required>
                <div class="faq-item">
                    <button class="faq-question" type="button">
                        Leave Now
                        <span class="icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <input type="date" name="date" class="date" required>
                    </div>
                </div>
                <button class="plan-btn" type="submit">Plan My Trip</button>
            </form>
        </div>
    </div>

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="./stations.php" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="./lines.html" class="nav-link px-2 text-body-secondary">Lines</a></li>
                <li class="nav-item"><a href="./FAQs.html" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                <li class="nav-item"><a href="./about.html" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
            <p class="text-center text-body-secondary">© 2024 Cairo2Capital Transport</p>
        </footer>
    </div>
    <script src="./stations.js"></script>
</body>
</html>
