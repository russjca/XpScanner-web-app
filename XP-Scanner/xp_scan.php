<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.php');
  exit();
}

// Connect to database
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'xpscanner_database';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_barcode = $_POST['barcode'];
  $product_name = $_POST['productName'];
  $product_category = $_POST['productCategory'];
  $product_expiration = $_POST['productExpiration'];

  // Get user ID from session variable
  $user_id = $_SESSION['id'];

  // Insert product into database
  $stmt = $con->prepare('INSERT INTO products (user_id, barcode, productName, productCategory, productExpiration) VALUES (?, ?, ?, ?, ?)');
  $stmt->bind_param('issss', $user_id, $product_barcode, $product_name, $product_category, $product_expiration);
  $stmt->execute();

  // Redirect user to product list page
  header('Location: main_scan.php');
  exit();
}
?>
