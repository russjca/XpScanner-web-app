<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) 
{
    header('Location: index.php');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'xpscanner_database';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) 
{
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,-25" />
    <link rel="stylesheet" href="css/main_account.css">

    <title>Account</title>
</head>
<body>
<section id="menu">
    <div class="logo">
      <img src="images/XP-Scanner-logo-nav.png" alt="">
      <h2>XP-Scanner</h2>
    </div>
    <div class="items">
      <li><i class='bx bxs-dashboard'></i><a href="main_dash.php">Dashboard</a></li>
      <li><i class='bx bxs-info-circle'></i><a href="main_about.php">About</a></li>
      <li><i class='bx bx-scan' ></i><a href="main_scan.php">Scan</a></li>
      <li><i class='bx bxs-file-find'></i><a href="main_manage.php">Manage</a></li>
      <li><i class='bx bxs-food-menu'></i><a href="#">Expired</a></li>
    </div>
  </section>

  <section id="interface" >
    <div class="navigation">

      <div class="profile">
        <a href="#" class="right-nav"><i class='bx bxs-bell'></i></a>
		    <a href="main_account.php" class="right-nav"><i class='bx bxs-user-circle'></i></a>
        <a href="xp_logout.php" class="right-nav""><i class='bx bxs-log-out'></i></a>
      </div>
    </div>

    <h3 class="i-name">
      Account Details
    </h3>

    <div class="values">
      <div class="val-box">
        <i class='bx bxs-box'></i>
          <div>
            <h3>Your account details are below: </h3>
            <span><strong>Username:  &nbsp; </strong><?=$_SESSION['name']?></span><br>
            <span><strong>Password:  &nbsp; </strong><<?=$password?></span><br>
            <span><strong>Email:  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </strong><?=$email?></span>
          </div>
      </div>
    </div>
  </section>
<!--   code para sa logout ngan welcome back user
  <section id="interface">
    <div class="logout-nav">
      <i class='bx bx-log-out'></i>
      <a href="xp_logout.php">
      <span class="nav-item">Logout</span>
      </a>

      <p>Welcome back, <?=$_SESSION['name']?>!</p>
    </div> -->
   
  </body>
  </html>