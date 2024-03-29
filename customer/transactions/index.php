<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    $customer_id = auth['id'];

    $sql = "SELECT * FROM transactions WHERE customer_id=$customer_id ORDER BY purchased_at DESC";
    $result = mysqli_query($conn, $sql);
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    include_once '../../inc/Head.php';
    include_once '../../inc/AdminNavigation.php' 
?>
<main>
    <header><h3 class="page-title">My Transactions</h3></header>
    <div class="container">
        <?php if (!empty($transactions)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Product</th>
                        <th></th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Purchased At</th>
                    </thead>
                    <tbody>
                        <?php foreach($transactions as $transaction) : ?>
                            <tr>
                                <td><img src="../../images/<?=(!empty($transaction['product_photo'])) ? $transaction['product_photo'] : 'placeholders/products.webp'; ?>"  height="120px" alt="<?= $transaction['product_name'] ?>"></td>
                                <td><?= $transaction['product_name'] ?></td>
                                <td>$<?= $transaction['price']?></td>
                                <td><?= $transaction['quantity'] ?></td>
                                <td>$<?= $transaction['price'] * $transaction['quantity'] ?></td>
                                <td><?= $transaction['purchased_at'] ?></td>
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