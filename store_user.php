<?php
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
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, email, address, phone, country, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $address, $phone, $country, $gender, $password);

// Execute the statement
if ($stmt->execute() === TRUE) {
    // Redirect to index.html on success
    header("Location: index.html");
    exit(); // Make sure to exit after the redirect
} else {
    // Display error message
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
