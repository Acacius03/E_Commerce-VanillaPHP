<?php 
include_once '../authentication.php';
include_once '../../config/database.php';
$title = 'Admin | Dashboard';

function getUserCount($conn) {
    $sql = "SELECT COUNT(id) FROM users WHERE account_type='customer'";
    $result = mysqli_query($conn, $sql);
    $count = $result->fetch_assoc();
    return $count['COUNT(id)'];
}
function getOrderCount($conn) {
    return 0;
}
function getMonthTotal($conn) {
    return 0;
}
function getRevenue($conn) {
    return 0;
}
function getRecentTransactions($conn) {
    $sql = "SELECT * FROM transactions ORDER BY 'purchased_at' DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $transactions;
}
?>
<?php include_once '../../inc/Head.php'; ?>
<?php include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header>
        <h3 class="page-title">Dashboard</h3>
    </header>
    <div class="container">
        <section class="Analytics">
            <div class="grid-2-cols main-grid">
                <div class="grid-2-cols">
                    <div class="grid-item flex">
                        <div class="flex-col">
                            <h4>Orders</h4>
                            <span><?= getOrderCount($conn) ?></span>
                        </div>
                        <div>icon</div>
                    </div>
                    <div class="grid-item flex">
                        <div class="flex-col">
                            <h4>Users</h4>
                            <span><?= getUserCount($conn) ?></span>
                        </div>
                        <div>icon</div>
                    </div>
                    <div class="grid-item flex">
                        <div class="flex-col">
                            <h4>Month Total</h4>
                            <span><?= getMonthTotal($conn) ?></span>
                        </div>
                        <div>icon</div>
                    </div>
                    <div class="grid-item flex">
                        <div class="flex-col">
                            <h4>Revenue</h4>
                            <span><?= getRevenue($conn) ?></span>
                        </div>
                        <div>icon</div>
                    </div>
                </div>
                <div class="grid-2-cols">
                    <div class="grid-item">
                        <h4>Sales Chart</h4>

                        </div>
                    <div class="grid-item"></div>
                </div>
                <div class="grid-span-full grid-item">
                    <h4>Recent Transactions</h4>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Purchased At</th>
                            </tr>
                            <?php foreach(getRecentTransactions($conn) as $transaction) : ?>
                                <tr>
                                    <td><?= $transaction['product_id']?></td>
                                    <td><?= $transaction['customer_id']?></td>
                                    <td><?= $transaction['qty']?></td>
                                    <td><?= $transaction['unit_price'] * $transaction['qty']?></td>
                                    <td><?= $transaction['purchased_at']?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
</div>
</body>
</html>