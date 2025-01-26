<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "trip";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function isAdmin($CustSSN) {
    global $conn;
    $query = "SELECT isAdmin FROM customer WHERE CustSSN = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $CustSSN);
    $stmt->execute();
    $stmt->bind_result($isAdmin);
    $stmt->fetch();
    $stmt->close();
    return $isAdmin; 
}

if (!isset($_SESSION['CustSSN']) || !isAdmin($_SESSION['CustSSN'])) {
    echo "Access denied. You do not have the privileges to view this page.";
    exit();
}
?>
