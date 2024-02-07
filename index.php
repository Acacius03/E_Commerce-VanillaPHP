<?php 
session_start();
include_once 'config/database.php';
$customer = $_SESSION['customer'] ?? NULL;
if ($customer) {
    $customer_id = $customer['id'];
    
    $sql = "SELECT * FROM cart WHERE customer_id=$customer_id";
    $result = mysqli_query($conn, $sql);
    $cart = $result->fetch_assoc();
    if ($cart){$cart_items = json_decode($cart['items'], TRUE);}
}
$sql = 'SELECT * FROM products';
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Commerce Site</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once 'inc/Navigation.php'?>
    <div class="container">
        <?php include_once 'inc/Header.php'?>
        <?php include_once 'inc/Products.php'?>
    </div>
    <script src="app.js"></script>
</body>
</html>