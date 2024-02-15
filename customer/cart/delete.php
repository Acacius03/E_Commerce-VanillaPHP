<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    if(isset($_GET['id'])){
        
        $customer_id = auth['id'];

        $sql = "SELECT items FROM cart WHERE customer_id=$customer_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $cart = $result->fetch_assoc();
        $cart_items = json_decode($cart['items'], TRUE);
        foreach ($cart_items as $index => $item) {
            if ($item['id'] === $_GET['id']){
                unset($cart_items[$index]);
                print_r(json_encode($cart_items));
                $sql = "UPDATE cart SET items='".json_encode($cart_items)."' WHERE customer_id=$customer_id";
                mysqli_query($conn, $sql);
                break;
            }
        }
    }
    header("LOCATION: ./");
    exit;