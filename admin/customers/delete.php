<?php 
    include_once '../../config/database.php';
    if (isset($_GET['id'])) {
        $sql = 'DELETE FROM users WHERE id='.$_GET['id'];
        mysqli_query($conn, $sql);
        header("LOCATION: ./");
        exit;
    }