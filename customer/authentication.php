<?php
    session_start();
    if (!isset($_SESSION['customer'])){
        header('Location: ../../login/');
        exit;
    }
    define('auth', $_SESSION['customer']);
    $links = ['profile', 'cart', 'transactions' ];
