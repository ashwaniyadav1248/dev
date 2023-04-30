<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jausty</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <?php session_start(); ?>
    <header>
        <div id="logo-cell">
            <h1 id="logo">Jausty</h1>
        </div>
        <div id="search-box">
            <input type="text" placeholder="Search for a product...">
            <button>Search</button>
        </div>
        <div id="header-icons">
            <a href="#"><img src="cart.png" alt="Cart"><span class="icon-text">View Cart</span></a>
            <div class="user-dropdown">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <a href="#" class="user-icon"><?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?></a>
                <?php else: ?>
                    <a href="#" class="user-icon"><img src="user.png" alt="User"></a>
                <?php endif; ?>
                <div class="dropdown">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="logout.php" id="logout-btn">Logout</a>
                    <?php else: ?>
                        <a href="#" id="login-btn">Login</a>
                        <a href="#" id="register-btn">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="row">
            <div class="column">
                <a href="grocery/grocery.php"><img src="grocery.jpg" alt="Grocery"></a>
                <h2><a href="grocery/grocery.php">Grocery</a></h2>
            </div>
            <div class="column">
                <a href="dairy_products/dairy_products.php"><img src="dairy product.jpg" alt="Dairy Product"></a>
                <h2><a href="dairy_products/dairy_products.php">Dairy Product</a></h2>
            </div>
            <div class="column">
                <a href="fruits_vegetables/fruits_vegetables.php"><img src="Fruits-and-Vegetables.jpg" alt="Vegetable and Fruits"></a>
                <h2><a href="fruits_vegetables/fruits_vegetables.php">Fruits & Vegetables</a></h2>
            </div>
        </section>
            <div id="login-form-overlay">
               <div id="login-form">
                  <h2>Login</h2>
                  <form id="login-form-data">
                     <div id="error-message-login"></div>
                     <label for="mobile">Mobile Number:</label>
                     <input type="text" id="mobile" name="mobile" required>
                     <label for="password">Password:</label>
                     <input type="password" id="password" name="password" required>
                     <button type="submit" id="login-btn-submit">Login</button>
                  </form>
                  <a href="#" id="close-btn-login">&times;</a>
               </div>
            </div>
            <div id="register-form-overlay">
               <div id="register-form">
                  <h2>Register</h2>
                  <form id="register-form-data">
				  
                     <div id="error-message-register"></div>
                     <label for="name">Name:</label>
                     <input type="text" id="name" name="name" required>
					 <label for="mobile">Mobile Number:</label>
                    <input type="text" id="mobile" name="mobile" required>
                    <label for="password">Create Password:</label>
                    <input type="password" id="password" name="password" required>
                    <label for="repassword">Re-enter Password:</label>
                    <input type="password" id="repassword" name="repassword" required>
                    <button type="submit" id="register-btn-submit">Create User</button>
                  </form>
                  <a href="#" id="close-btn-register">&times;</a>
               </div>
            </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script>
   $(document).ready(function() {
      // ...
   
      // Submit the registration form using AJAX when the Create User button is clicked
      $('#register-btn-submit').on('click', function(e) {
         e.preventDefault();
      
         var formData = $('#register-form-data').serialize();
         $.ajax({
            type: 'POST',
            url: 'register.php',
            data: formData,
            success: function(response) {
               console.log(response);
               if (response.success) {
                  // If the registration is successful, display a success message
                  $('#error-message-register').text(response.message);
               } else {
                  // If the registration is unsuccessful, display an error message
                  $('#error-message-register').text(response.message);
               }
            },
            error: function(xhr, status, error) {
               console.log(xhr.responseText);
            }
         });
      });
   
      // Submit the login form using AJAX when the Login button is clicked
      $('#login-btn-submit').on('click', function(e) {
         e.preventDefault();
         
         var formData = $('#login-form-data').serialize();
         $.ajax({
            type: 'POST',
            url: 'login.php',
            data: formData,
            success: function(response) {
               console.log(response);
               if (response.success) {
                  // If the login is successful, reload the page
                  location.reload();
               } else {
                  // If the login is unsuccessful, display an error message
                  $('#error-message-login').text(response.message);
               }
            },
            error: function(xhr, status, error) {
               console.log(xhr.responseText);
            }
         });
      });
   });
</script>
</main>
</html>
