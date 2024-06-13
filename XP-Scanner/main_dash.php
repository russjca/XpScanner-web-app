<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,-25" />
    <link rel="stylesheet" href="css/main_dash.css">

    <title>Dashboard</title>
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

  <section id="interface">
    <div class="navigation">
      <div class="profile">
        <a href="#" class="right-nav"><i class='bx bxs-bell'></i></a>
		    <a href="main_account.php" class="right-nav"><i class='bx bxs-user-circle'></i></a>
        <a href="xp_logout.php" class="right-nav""><i class='bx bxs-log-out'></i></a>
      </div>
    </div>

    <h3 class="i-name">
      Dashboard
    </h3>

    <div class="values">
      <div class="val-box">
        <i class='bx bxs-box'></i>
          <div>
            <h3>89</h3>
            <span>Products</span>
          </div>
      </div>
      <div class="val-box">
        <i class='bx bxs-time'></i>
          <div>
            <h3>56</h3>
            <span>Expired</span>
          </div>
      </div>
      <div class="val-box">
        <i class='bx bxs-category' ></i>
          <div>
            <h3>12</h3>
            <span>Categories</span>
          </div>
      </div>
      <div class="val-box">
        <i class='bx bx-barcode-reader'></i>
          <div>
            <h3>256</h3>
            <span>Scanned</span>
          </div>
      </div>
    </div>
  </section>

  </body>
  </html>