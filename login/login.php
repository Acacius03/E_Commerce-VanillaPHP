<?php 
    include '../config/database.php';
    session_start();
    if (isset($_POST['submit'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($email) || empty($password)){
            $_SESSION['message'] = 'Please fill all fields!';
            header("LOCATION: $_SERVER[HTTP_REFERER]");
            exit;
        }
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $user = $result->fetch_assoc();
        if (!$user && !password_verify($password, $user['password'])) {
            $_SESSION['Message'] = 'Invalid Credentials';
            header("LOCATION: $_SERVER[HTTP_REFERER]");
            exit;
        }
        session_regenerate_id();
        if ($user['account_type'] == 'customer'){
            $_SESSION['customer'] = $user;
            header('Location: ../');
            exit;
        }
        if ($user['account_type'] == 'admin'){
            $_SESSION['admin'] = $user;
            header('Location: ../admin/');
            exit;
        }
    }