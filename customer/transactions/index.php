<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    $customer_id = auth['id'];

    $sql = "SELECT * FROM transactions WHERE customer_id=$customer_id ORDER BY purchased_at DESC";
    $result = mysqli_query($conn, $sql);
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include_once '../../inc/Head.php'; ?>
<?php include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header><h3 class="page-title">My Transactions</h3></header>
    <div class="container">
        <?php if (!empty($transactions)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Prodct Photo</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Purchased At</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php foreach($transactions as $transaction) : ?>
                            <tr data-product-id="<?= $transaction['product_id'] ?>">
                                <td><img src="../../images/<?=(!empty($transaction['product_photo'])) ? $transaction['product_photo'] : 'placeholders/products.webp'; ?>"  height="120px" alt="<?= $transaction['product_name'] ?>"></td>
                                <td><?= $transaction['product_name'] ?></td>
                                <td>$<?= $transaction['unit_price']?></td>
                                <td><?= $transaction['qty'] ?></td>
                                <td><?= $transaction['purchased_at'] ?></td>
                                <td>$<?= $transaction['unit_price'] * $transaction['qty'] ?></td>
                            </tr>                
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else:?>
            <h2 style="text-align: center; padding:20px;">There are no transactions made</h2>
        <?php endif ?>
    </div>
</main>
</body>
</html>