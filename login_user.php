<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM users WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    if ($password === $stored_password) {
        // Password is correct
        $_SESSION['username'] = $username;
        header("Location: index.html");
        exit();
    } else {
        // Password is incorrect
        echo "<script>alert('Invalid password'); window.location.href='login.html';</script>";
    }
} else {
    // Username does not exist
    echo "<script>alert('No user found with that username'); window.location.href='login.html';</script>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
