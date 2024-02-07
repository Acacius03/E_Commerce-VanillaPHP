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
    <link rel="stylesheet" href="style.css">
    <!-- <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script> -->
    <!-- <script src="./validation.js" defer></script> -->
</head>
<body>
    <form action="login.php" method="POST" id="login-form" novalidate>
        <?php if(isset($_SESSION['message'])) echo $_SESSION['message'] ?>
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" autocomplete='off'>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <input type="submit" id="submit" name="submit" value="Log In">
    </form>
</body>
</html>