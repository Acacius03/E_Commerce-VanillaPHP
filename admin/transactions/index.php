<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    $sql = "SELECT * FROM transactions ORDER BY purchased_at DESC";
    $result = mysqli_query($conn, $sql);
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    include_once '../../inc/Head.php';
    include_once '../../inc/AdminNavigation.php' 
?>
<main>
    <header><h3 class="page-title">Transactions</h3></header>
    <div class="container">
        <?php if (!empty($transactions)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Product ID</th>
                        <th>Customer ID</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Purchased At</th>
                    </thead>
                    <tbody>
                        <?php foreach($transactions as $transaction) : ?>
                            <tr>
                                <td><?= $transaction['product_id']?></td>
                                <td><?= $transaction['customer_id']?></td>
                                <td><?= $transaction['quantity']?></td>
                                <td>P<?= $transaction['price'] * $transaction['quantity']?></td>
                                <td><?= $transaction['purchased_at']?></td>
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