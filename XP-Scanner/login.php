<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
  <title>Login</title>
</head>
<body>
  <section class="tabs">
    <header class="header-tabs">
      <a href="index.php"> <img src="images/XP-Scanner-wordmark-home.png" class="logo" alt="XP-Scanner Logo"></a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="login.php">Sign In</a></li>
        </ul>
    </header>
    <section class="container forms">
      <!-- Login Form -->
      <div class="form login">
        <div class="form-content">
            <header class="login-header">Login</header>
            
              <form action="xp_login.php" method="post">
              <?php if (isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?></p>
              <?php } ?>

                <div class="field input-field">
                  <input type="text" class="username" placeholder="Username" id="username" name="username">
                </div>
  
                <div class="field input-field">
                  <input type="password" class="password" placeholder="Password" id="password" name="password">
                  <i class='bx bx-hide eye-icon'></i>
                </div>

                <div class="form-link">
                  <a href="#" class="forgot-pass">Forgot password?</a>
                </div>
                
                <div class="field button-field">
                  <button>Login</button>
                </div>
                
                <div class="form-link">
                  <span>Already have an account? <a href="#" class="link signup-link">Signup</a></span>
                </div>
              </form>
            </div>
          </div>

        <!-- Signup Form -->
          <div class="form signup">
            <div class="form-content">
                <header class="login-header">Signup</header>
                
                  <form action="xp_signup.php" method="post">

                    <div class="field input-field">
                      <input type="text" class="username" placeholder="Username" id="username" name="username" required>
                    </div>

                    <div class="field input-field">
                      <input type="email" class="input" placeholder="Email" id="email" name="email" required>
                    </div>
      
                    <div class="field input-field">
                      <input type="password" class="password" placeholder="Password" id="password" name="password" required>
                      <i class='bx bx-hide eye-icon'></i>
                    </div>
    
                    <div class="field button-field">
                      <button>Signup</button>
                    </div>
                    
                    <div class="form-link">
                      <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                  </form>
                </div>
              </div>
        </section>
  </section>

      <!-- JavaScript -->
      <script src="js/script.js">
    
      </script>
</body>
</html>