<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    $customer_id = auth['id'];

    $sql = "SELECT * FROM cart WHERE customer_id=$customer_id";
    $result = mysqli_query($conn, $sql);
    $cart = $result->fetch_assoc();
    $products = [];

    if ($cart){
        $cart_items = json_decode($cart['items'], TRUE);
        if (!empty($cart_items)){
            $itemIds = array();
            foreach ($cart_items as $item) {
                $itemIds[] = $item['id'];
            }
            $itemIdsString = implode(',', $itemIds);
            print_r($itemIdsString);
            // Query to fetch product information for all items in the cart
            $sql = "SELECT * FROM products WHERE id IN ($itemIdsString)";
            $result = mysqli_query($conn, $sql);
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
?>
<?php include_once '../../inc/Head.php'; ?>
<?php include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header><h3 class="page-title">My Cart</h3></header>
    <div class="container">
        <a class="btn" href="./clear.php">Remove all</a>
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                </tr>
                <?php foreach($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><img src="../../images/<?=(!empty($product['image'])) ? $product['image'] : 'placeholders/products.webp'; ?>"  height="120px" alt="<?= $product['name'] ?>"></td>
                        <td><?= $product['name'] ?></td>
                        <td>$<?= $product['price']?></td>
                        <td><?= $item['qty'] ?></td>
                        <td>$<?= $product['price'] * $item['qty'] ?></td>
                    </tr>                
                <?php endforeach ?>
            </table>
        <input class="cta" type="submit" value="checkout"/>
        </div>
    </div>
</main>
</body>
</html>