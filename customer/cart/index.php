<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';

    $customer_id = auth['id'];

    $sql = "SELECT items FROM cart WHERE customer_id=$customer_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $cart = $result->fetch_assoc();
    $products = [];

    if ($cart){
        $cart_items = json_decode($cart['items'], TRUE);
        if (!empty($cart_items)){
            $itemIds = array();
            foreach ($cart_items as $item) {$itemIds[] = $item['id'];}
            $itemIdsString = implode(',', $itemIds);
            $sql = "SELECT * FROM products WHERE id IN ($itemIdsString) ORDER BY FIELD(id, $itemIdsString)";
            $result = mysqli_query($conn, $sql);
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
    
    if (isset($_POST['submit'])){
        foreach ($cart_items as $index => $item) {
            if ($item['id'] === $_POST['id']){
                $cart_items[$index]['qty'] = $_POST['quantity'];
                $sql = "UPDATE cart SET items='".json_encode($cart_items)."' WHERE customer_id=$customer_id";
                mysqli_query($conn, $sql);
            }
        }
    }

    include_once '../../inc/Head.php';
    include_once '../../inc/AdminNavigation.php'
?>
<main>
    <header><h3 class="page-title">My Cart</h3></header>
    <div class="container">
        <?php if (!empty($cart_items)): ?>
            <a class="btn clear-cart" href="./clear.php">Remove all</a>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $total = 0 ?>
                        <?php foreach($products as $index => $product) : ?>
                            <tr>
                                <td><img src="../../images/<?= $product['image'] ?? 'placeholders/products.webp'; ?>"  height="200px" alt="<?= $product['name'] ?>"></td>
                                <td><?= $product['name'] ?></td>
                                <td>$<?= $product['price']?></td>
                                <td>
                                    <form method="POST">
                                        <input type="number" name="id" value="<?= $product['id']?>" style="display:none">
                                        <input type="number" name="quantity" id="quantity" max=99 value="<?= $cart_items[$index]['qty'] ?>">
                                        <input type="submit" name="submit" id="submit" value="Submit" style="display:none">
                                    </form>
                                </td>
                                <td>$<?= $product['price'] * $cart_items[$index]['qty'] ?></td>
                                <td>
                                    <a href="delete.php?id=<?= $product['id'] ?>" class="table-item-action delete"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>                
                            <?php $total += ($product['price'] * $cart_items[$index]['qty']) ?>
                        <?php endforeach ?>    
                    </tbody>
                </table>
                <form action="checkout.php" method="POST" style="padding:4px">
                    <h1 style="border-block:1px solid black; text-align:right; padding: 12px;margin-inline:20px;margin-bottom:4px;">
                        <span style="margin-right:20px;">
                            Total: 
                        </span>
                        <span>
                            $<?= $total ?>
                        </span>
                    </h1>
                    <input type="submit" id="checkout" name="checkout" value="Checkout" class="cta">
                </form>
            </div>
        <?php else:?>
            <h2 style="text-align: center; padding:20px;">Cart is empty</h2>
        <?php endif ?>
    </div>
</main>
<script>
    document.querySelector('#quantity').addEventListener('blur', () => {
        document.querySelector('#submit').click();
    })
</script>
</body>
</html>