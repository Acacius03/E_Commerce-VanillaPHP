<nav>
    <div class="container">
        <a href="/Site1" class="branding">
            <img src="/Site1/images/logo.png" width="64px" height="48px" alt="Company Logo">
        </a>
        <div class="flex">
            <?php if (!isset($_SESSION['admin']) && !isset($customer)): ?>
                <a href="/Site1/login" class="btn cta">login</a>
            <?php elseif(isset($_SESSION['admin'])) :?>
                <a href="/Site1/admin/" class="btn">Dashboard</a>
                <a href="/Site1/logout" class="btn">Log Out</a>
            <?php else :?>
                <div class="dropdown cart">
                    <label>
                        <span>My Cart</span>
                        <input type="checkbox" class="dropdown-toggle">
                    </label>
                    <ul>
                        <?php if (!empty($cart_items)): ?>
                            <?php 
                                $total = 0; 
                                
                                $itemIds = array();
                                foreach ($cart_items as $index => $item) {
                                    $itemIds[] = $item['id'];
                                    if($index == 2){break;}
                                }
                                $itemIdsString = implode(',', $itemIds);
                                $sql = "SELECT name, price, image FROM products WHERE id IN ($itemIdsString) ORDER BY FIELD(id, $itemIdsString) LIMIT 3";
                                $result = mysqli_query($conn, $sql);
                                $productsInCart = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            ?>
                            <?php foreach($cart_items as $index => $item): ?>
                                <?php $total += ($productsInCart[$index]['price'] * $item['qty']) ?>
                                <li>
                                    <div class="cart-item">
                                        <img src="images/<?= (!empty($productsInCart[$index]['image'])) ? $productsInCart[$index]['image'] : 'placeholders/products.png'; ?>"
                                        width="64px" height="84px" alt="<?= $productsInCart[$index]['name']?>">
                                        <div class="cart-item-info">
                                            <h3><?= $productsInCart[$index]['name']?></h3>
                                            <small>
                                                <span class="cart-item-price">$<?= $productsInCart[$index]['price']?></span>
                                                <span>Quantity: <?= $item['qty']?></span>
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <?php if($index == 2){break;}?>
                            <?php endforeach ?>
                            <li class="checkout">
                                <span class="total">Total: $<?= $total ?></span>
                                <a href="/Site1/customer/cart" class="btn cta">View all items</a>
                            </li>
                        <?php else: ?>
                            <li>The cart is empty</li>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="dropdown">
                    <label>
                        <span><?= $customer['first_name'] ?> <?= $customer['last_name'] ?></span>
                        <input type="checkbox" class="dropdown-toggle">
                        <img class="circle" src="images/<?= (!empty($customer['avatar'])) ? $customer['avatar'] : 'placeholders/avatar.jpg'; ?>" height="32px" alt="">
                    </label>
                    <ul>
                        <li>
                            <a href="./customer/">
                                <span>My Account</span>
                                <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                        </li>
                        <li><a href="/Site1/logout">Log Out</a></li>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </div>
</nav>