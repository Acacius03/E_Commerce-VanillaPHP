<?php
session_start();
if (!isset($_SESSION['admin'])){
    header('Location: /Site1/login/');
    exit;
}
define('auth', $_SESSION['admin']);
$links = ['dashboard', 'inventory', 'customers', 'profile'];
