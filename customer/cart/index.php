<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    $customer_id = auth['id'];

    $sql = "SELECT * FROM cart WHERE customer_id=$customer_id";
    $result = mysqli_query($conn, $sql);
    $cart = $result->fetch_assoc();
    if ($cart){$cart_items = json_decode($cart['items'], TRUE);}
?>
<?php include_once '../../inc/Head.php'; ?>
<?php include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header><h3 class="page-title">My Cart</h3></header>
    <div class="container">
        <a href="./clear.php">Remove all</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
            </tr>
            <?php foreach($cart_items as $item) : ?>
                <?php 
                    $sql = "SELECT * FROM products WHERE id=".$item['id'];
                    $result = mysqli_query($conn, $sql);
                    $product = $result->fetch_assoc();
                ?>
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
    </div>
</main>
</body>
</html>