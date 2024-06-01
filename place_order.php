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
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$total_price = $price * $quantity;
$user_id = $_SESSION['username']; // Assuming user is logged in and user ID is stored in session

// Insert order into database
$stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiid", $user_id, $product_id, $quantity, $total_price);

if ($stmt->execute() === TRUE) {
    // Redirect to a thank you page or orders summary page
    header("Location: order_success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
