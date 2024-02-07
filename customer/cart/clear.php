<?php
include_once '../authentication.php';
include_once '../../config/database.php';
$customer_id = $_SESSION['customer']['id'];
$sql = "UPDATE cart SET items='[]' WHERE customer_id=$customer_id";
mysqli_query($conn, $sql);
header("LOCATION: $_SERVER[HTTP_REFERER]");
