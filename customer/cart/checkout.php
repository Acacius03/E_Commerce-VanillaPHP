<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';
    if (isset($_POST['checkout'])){
        $customer_id = auth['id'];
    
        $sql = "SELECT * FROM cart WHERE customer_id=$customer_id";
        $result = mysqli_query($conn, $sql);
        $cart = $result->fetch_assoc();
    
        if ($cart){
            $cart_items = json_decode($cart['items'], TRUE);
            if (!empty($cart_items)){
                $itemIds = array();
                foreach ($cart_items as $item) {$itemIds[] = $item['id'];}
                $itemIdsString = implode(',', $itemIds);
                $sql = "SELECT name, price, image FROM products WHERE id IN ($itemIdsString) ORDER BY FIELD(id, $itemIdsString)";
                $result = mysqli_query($conn, $sql);
                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach($cart_items as $index => $item) {
                    print_r($products[$index]['price']);
                    $sql = "INSERT INTO transactions (customer_id, product_id, product_photo, product_name, qty, unit_price) VALUES ($customer_id, ".$item['id'].", '".$products[$index]['image']."', '".$products[$index]['name']."', ".$item['qty'].", ".$products[$index]['price'].")";
                    mysqli_query($conn, $sql);
                }   
                $sql = "UPDATE cart SET items='[]' WHERE customer_id=$customer_id";
                mysqli_query($conn, $sql);
            }
        }
    }
    // header("LOCATION: $_SERVER[HTTP_REFERER]");
    // exit;