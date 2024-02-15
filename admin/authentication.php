<?php
    session_start();
    if (!isset($_SESSION['admin'])){
        header('Location: ../../login/');
        exit;
    }
    define('auth', $_SESSION['admin']);
    $links = ['dashboard', 'inventory', 'customers', 'transactions','profile'];
