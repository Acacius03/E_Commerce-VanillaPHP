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
        <a href="clear.php">Remove all</a>
        <table>
            <?php foreach($cart_items as $item) : ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><img src="../images/<?=(!empty($item['image'])) ? $item['image'] : 'placeholders/products.webp'; ?>"  height="120px" alt="<?= $item['name'] ?>"></td>
                    <td><?= $item['name'] ?></td>
                    <td>$<?= $item['price']?>/pc</td>
                    <td><?= $item['qty'] ?><?= ($item['qty'] > 1) ? 'pcs' : 'pc'; ?></td>
                    <td>$<?= $item['price'] * $item['qty'] ?></td>
                </tr>                
            <?php endforeach ?>
        </table>
    </div>
</main>
</body>
</html>