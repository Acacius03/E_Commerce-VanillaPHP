<?php 
    session_start();
    
    session_destroy();

    header('location: /Site1/');
    exit
?>