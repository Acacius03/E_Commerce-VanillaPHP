<?php 
    session_start();
    if (isset($_SESSION['admin']) || isset($_SESSION['customer'])){
        header('Location: /Site1/');
    }
?>
<?php include 'register.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="./validation.js" defer></script>
</head>
<body>
<h1>Signup</h1>
<form method="POST" id="signup-form" novalidate>
    <div>
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" autocomplete='off'>
    </div>
    <div>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" autocomplete='off'>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" autocomplete='off'>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>