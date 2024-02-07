<?php 
session_start();
if (isset($_SESSION['admin']) || isset($_SESSION['customer'])){
    header('Location: /Site1/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../default.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <div class="login-container">
        <figure>
          <img src="loginLogo.jpg" alt="" />
        </figure>
        <section class="login-section">
            <hgroup>
              <h1>Login</h1>
              <p>Welcome back! Please login to your account.</p>
            </hgroup>
            <form action="login.php" method="POST" id="login-form" class="form" novalidate>
              <?= $_SESSION['message'] ?? NULL ?>
              <div class="input-field">
                  <label class="label" for="email">Email</label>
                  <input type="text" id="email" name="email" autocomplete='off'>
              </div>
              <div class="input-field">
                  <label class="label" for="password">Password</label>
                  <input type="password" id="password" name="password">
              </div>

              <div class="remember-me">
                  <input id="remember-me" type="checkbox" />
                  <h4>Remember Me</h4>
                  <a href="#" class="Forgot">Forgot Password?</a>
              </div>

              <input type="submit" id="submit" name="submit" value="Log In">

            </form>
            <div class="signup">
                <span>Don't have an account? </span><a href="../register/">Signup</a>
            </div>
        </section>
      </div>
  </main>

  </body>
</html>