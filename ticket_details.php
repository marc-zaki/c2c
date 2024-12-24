<?php
session_start(); 

if (!isset($_SESSION['ticketID'])) {
    header("Location: stations.php");
    exit();
}

$ticketID = $_SESSION['ticketID'];
unset($_SESSION['ticketID']);
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "trip";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT startLocation, endLocation, schedule FROM ticket WHERE ticketID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ticketID);
$stmt->execute();
$result = $stmt->get_result();
$ticket = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./ticket-details.css">
</head>
<body>
    <div class="container">
        <div class="ticket">
            <h2>Ticket Details</h2>
            <div class="ticket-details">
                <p><strong>Ticket ID:</strong> <?php echo htmlspecialchars($ticketID); ?></p>
                <p><strong>From:</strong> <?php echo htmlspecialchars($ticket['startLocation']); ?></p>
                <p><strong>To:</strong> <?php echo htmlspecialchars($ticket['endLocation']); ?></p>
                <p><strong>Schedule:</strong> <?php echo htmlspecialchars($ticket['schedule']); ?></p>
            </div>
            <a href="stations.php" class="btn btn-success">Plan Another Trip</a>
        </div>
    </div>
</body>
</html>
