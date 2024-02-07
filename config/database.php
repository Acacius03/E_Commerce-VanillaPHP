<?php

define('DB_Host', 'localhost');
define('DB_User', 'root');
define('DB_PASS', '');
define('DB_NAME', 'e_commerce');

//Create Connection
$conn = new mysqli(DB_Host, DB_User, DB_PASS, DB_NAME);
//Check Connection
if ($conn->connect_error) {
    die('Connection Failed' . $conn->connect_error);
};