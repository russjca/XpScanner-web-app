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

  // Get user ID from session variable
$user_id = $_SESSION['id'];

// Select products for the current user
$stmt = $con->prepare('SELECT * FROM products WHERE user_id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();

  // Redirect user to product list page
  header('Location: main_scan.php');
  exit();

?>
