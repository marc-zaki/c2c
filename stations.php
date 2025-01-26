<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$trip_db = "trip";
$signup_db = "trip";
include("functions.php");

$conn_trip = new mysqli($dbhost, $dbuser, $dbpass, $trip_db);
if ($conn_trip->connect_error) {
    die("Connection to trip database failed: " . $conn_trip->connect_error);
}

$conn_signup = new mysqli($dbhost, $dbuser, $dbpass, $signup_db);
if ($conn_signup->connect_error) {
    die("Connection to signup database failed: " . $conn_signup->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['CustSSN'])) {
        die("Error: custSSN is not set in the session.");
    }

    $custSSN = $_SESSION['CustSSN'];
    $startLocation = $_POST["plan-from"];
    $endLocation = $_POST["plan-to"];
    $schedule = $_POST["date"];

    $sqlInsert_ticket = "INSERT INTO ticket (startLocation, endLocation, schedule) VALUES (?, ?, ?)";
    $stmt_ticket = $conn_trip->prepare($sqlInsert_ticket);
    $stmt_ticket->bind_param("sss", $startLocation, $endLocation, $schedule);

    if ($stmt_ticket->execute()) {
        $ticketID = $stmt_ticket->insert_id; 
        $_SESSION['ticketID'] = $ticketID;

        echo "Ticket inserted successfully with ID: " . $ticketID . "<br>";

        $sqlUpdate_customer = "UPDATE customer SET tickID = ? WHERE custSSN = ?";
        $stmt_customer = $conn_signup->prepare($sqlUpdate_customer);
        $stmt_customer->bind_param("is", $ticketID, $custSSN);

        echo "Executing SQL: " . $sqlUpdate_customer . " with parameters: ticketID = " . $ticketID . ", custSSN = " . $custSSN . "<br>";

        if ($stmt_customer->execute()) {
            header("Location: ticket_details.php");
            exit();
        } else {
            echo "Failed to update customer table: " . $stmt_customer->error . "<br>";
            echo "Error code: " . $stmt_customer->errno . "<br>";
        }
        $stmt_customer->close();
    } else {
        echo "Failed to insert into ticket table: " . $stmt_ticket->error . "<br>";
        echo "Error code: " . $stmt_ticket->errno . "<br>";
    }

    $stmt_ticket->close();
}

$conn_trip->close();
$conn_signup->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stations</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./stations.css">
</head>
<body>
    <div class="header">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin Portal
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./1train_details.php">Train Details</a></li>
                        <li><a class="dropdown-item" href="./2stations_details.php">Stations Details</a></li>
                        <li><a class="dropdown-item" href="./3maintenance.php">Maintenance</a></li>
                        <li><a class="dropdown-item" href="./4line_details.php">Line Details</a></li>
                        <li><a class="dropdown-item" href="./5drivers_details.php">Drivers Details</a></li>
                    </ul>
                </li>
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

    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="./stations.php" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="./lines.html" class="nav-link px-2 text-body-secondary">Lines</a></li>
            <li class="nav-item"><a href="./FAQs.html" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="./about.html" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Cairo2Capital Transport</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="stations.js"></script>
</body>
</html>
