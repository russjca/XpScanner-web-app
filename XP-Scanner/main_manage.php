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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/main_manage.css">

    <title>Manage</title>
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
      Manage
    </h3>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Manage Products here</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Expiration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                  
                                    <?php
                                        $con = mysqli_connect("localhost", "root", "", "xpscanner_database");
                                        $user_id = $_SESSION['id'];
                                        
                                        $query = "SELECT * FROM products WHERE user_id = '$user_id'";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?= $row['barcode'] ?></td>
                                                        <td><?= $row['productName'] ?></td>
                                                        <td><?= $row['productCategory'] ?></td>
                                                        <td><?= $row['productExpiration'] ?></td>
                                                        <td class="buttons">
                                                        <div class="enter">
                                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#editModal" name="editBtn">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            </button>

                                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                                            <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            

            <form action="xp_update.php" method="post">
            
            <div class="form-group">
                <label>Barcode</label>
                    <input type="hidden" name="product_id">
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
                <button type="submit" class="btn btn-primary" name="updateData">Save changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            <form action="xp_update.php" method="post">
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
                <button type="submit" class="btn btn-primary" name="deleteData">Save changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>
  </section>
    
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  </html>