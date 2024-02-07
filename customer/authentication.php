<?php
session_start();
if (!isset($_SESSION['customer'])){
    header('Location: /Site1/login/');
    exit;
}
define('auth', $_SESSION['customer']);
$links = ['dashboard', 'cart', 'transactions', 'profile'];
