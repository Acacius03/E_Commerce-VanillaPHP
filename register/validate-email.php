<?php 
include '../config/database.php';
if (isset($_GET['email'])){
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $is_available = $result->num_rows === 0;

    header('Content-Type: application/json');
    echo json_encode(["available" => $is_available]);
}
?>