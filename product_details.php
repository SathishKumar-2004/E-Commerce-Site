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

// Get product ID from query string
$product_id = $_GET['id'];

// Fetch product details from database
$stmt = $conn->prepare("SELECT name, price, quantity, reviews FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($name, $price, $quantity, $reviews);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" type="text/css" href="new_styles.css">
</head>
<body>
    <div class="product-details">
        <h1><?php echo htmlspecialchars($name); ?></h1>
        <p>Price: $<?php echo htmlspecialchars($price); ?></p>
        <p>Quantity: <?php echo htmlspecialchars($quantity); ?></p>
        <p>Reviews: <?php echo htmlspecialchars($reviews); ?></p>

        <form action="place_order.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
            <label for="quantity">Quantity to Order:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="<?php echo htmlspecialchars($quantity); ?>" required><br>
            <input type="submit" class="place-order-btn" value="Place Order">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
