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
    <link rel="stylesheet" href="css/main_scan.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Scan Product</title>
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
      Scan Product
    </h3>

    <div class="values">
      <div class="val-box">
        <div class="scan">
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#scanBarcodeModal" id="scanBarBtn">
          <i class='bx bxs-box'></i> Scan Barcode
          </button>
        </div>

        <div class="enter">
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#enterBarcodeModal">
          <i class='bx bxs-edit'></i> Enter Barcode
          </button>
      </div>
    </div>
    </div>
  </section>

  <div class="modal fade" id="scanBarcodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Scan Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="xp_scan.php" method="post">
        
<style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #reader {
            width: 400px;
            align-items: center;
        }
        #result {
            text-align: center;
            font-size: 1.5rem;
        }
      </style>

        <div id="reader"></div>
        <div id="result"></div>

      <!-- Script for QrBarcodeScanner -->
      <script>
        const scanner = new Html5QrcodeScanner('reader',
        { 
          qrbox: 
          {
            width: 250,
            height: 250,
          },
          fps: 20,
        });

        const scanButton = document.getElementById('scanBarBtn');

scanBarBtn.addEventListener('click', () => {
  scanner.render(success);
});

function success(result) {
  
  // Set the value of the input field with ID 'barcode' to the result
  document.getElementById('barcode').value = result;
  
  scanner.clear();
  document.getElementById('reader').remove();
}

      </script>
      <!-- Script for QrBarcodeScanner -->
      <div class="form-group">
          <label>Barcode</label>
            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Enter Barcode">
        </div>

        <div class="form-group">
          <label>Product Name</label>
            <input type="text" class="form-control" name="productName" placeholder="Enter Product Name">
        </div>

        <div class="form-group">
          <label>Product Category</label>
            <input type="text" class="form-control" name="productCategory" placeholder="Enter Product Category">
        </div>

        <div class="form-group">
          <label>Product Expiration</label>
            <input type="date" class="form-control" name="productExpiration" placeholder="Enter Product Expiration">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="insertData">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="enterBarcodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Enter Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      <form action="xp_scan.php" method="post">
      <div class="form-group">
          <label>Barcode</label>
            <input type="text" class="form-control" name="barcode" placeholder="Enter Barcode">
        </div>

        <div class="form-group">
          <label>Product Name</label>
            <input type="text" class="form-control" name="productName" placeholder="Enter Product Name">
        </div>

        <div class="form-group">
          <label>Product Category</label>
            <input type="text" class="form-control" name="productCategory" placeholder="Enter Product Category">
        </div>

        <div class="form-group">
          <label>Product Expiration</label>
            <input type="date" class="form-control" name="productExpiration" placeholder="Enter Product Expiration">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="insertData">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  </html>