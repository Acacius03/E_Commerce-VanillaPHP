<?php 
include '../config/database.php';
if (isset($_POST['submit'])){
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password_confirm = filter_input(INPUT_POST, 'password_confirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($first_name) || empty($last_name)) {die('Name is required');}
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {die('Valid Email is required');}

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($user) {die('Email is already taken');}
    if (strlen($password) < 8) {die('Password must be at least 8 characters');}
    if (!preg_match("/[a-z]/i", $password)) {die('Password must contain at least one letter');}
    if (!preg_match("/[0-9]/i", $password)) {die('Password must contain at least one number');}
    if ($password != $password_confirm) {die('Password must match');}

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name','$last_name','$email','$password_hash')";
    mysqli_query($conn, $sql);

    header('Location: ../login');
    exit;
}
?>