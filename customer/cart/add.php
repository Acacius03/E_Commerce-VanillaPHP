<?php 
include_once '../authentication.php';
include_once '../../config/database.php';

if (isset($_GET['id'])) {

    $customer_id = auth['id'];
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id=$product_id";
    $result = mysqli_query($conn, $sql);
    $product = $result->fetch_assoc();

    $sql = "SELECT * FROM cart WHERE customer_id=$customer_id";
    $result = mysqli_query($conn, $sql);
    $cart = $result->fetch_assoc();

    if ($cart){
        $cart_items = json_decode($cart['items'], TRUE);
        $item_exist = FALSE;

        foreach ($cart_items as $index => $item){
            if ($item['id'] == $product_id){
                $cart_items[$index]['qty'] += 1;
                $item_exist = TRUE;
                break;
            }
        }

        if (!$item_exist) {$cart_items[] = ['id' => $product['id'], 'qty' => 1];}

        $cart_items = json_encode($cart_items);        
        $sql = "UPDATE cart SET items='$cart_items' WHERE customer_id=$customer_id";
        
    } else {
        $cart_items = json_encode([['id' => $product['id'], 'qty' => 1]]);        
        $sql = "INSERT INTO cart (customer_id, items) VALUES ($customer_id, '$cart_items')";
    }
    mysqli_query($conn, $sql);
}

header("LOCATION: /Site1/");
exit;
