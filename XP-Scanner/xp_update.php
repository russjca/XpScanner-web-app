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

// Retrieve user's ID
$userID = $_SESSION['id'];

// Check if the form has been submitted for updating the product data
if (isset($_POST['updateData'])) {
    $id = $_POST['product_id'];
    $barcode = $_POST['barcode'];
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productExpiration = $_POST['productExpiration'];

    // Prepare the SQL statement to update the product data
    $stmt = $con->prepare('UPDATE products SET barcode=?, productName=?, productCategory=?, productExpiration=? WHERE user_id=? AND product_id=?');
    $stmt->bind_param('ssssii', $barcode, $productName, $productCategory, $productExpiration, $userID, $id);
    $stmt->execute();

    // Close the prepared statement and redirect back to the main dashboard page
    $stmt->close();
    header('Location: main_dash.php');
    exit();
}

// Check if the form has been submitted for deleting the product data
if (isset($_POST['deleteData'])) {
    $id = $_POST['product_id'];

    // Prepare the SQL statement to delete the product data
    $stmt = $con->prepare('DELETE FROM products WHERE user_id = ? AND product_id = ?');
    $stmt->bind_param('ii', $userID, $id);
    $stmt->execute();

    // Close the prepared statement and redirect back to the main dashboard page
    $stmt->close();
    header('Location: main_dash.php');
    exit();
}

// Select products for the current user
$stmt = $con->prepare('SELECT * FROM products WHERE user_id = ?');
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();

// Close the prepared statement
$stmt->close();

// Close the database connection
$con->close();
?>
