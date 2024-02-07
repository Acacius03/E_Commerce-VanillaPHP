<nav>
    <div class="container">
        <a href="/Site1" class="branding">
            <img src="/Site1/images/logo.png"
            width="64px"
            height="48px"
            alt="Company Logo">
        </a>
        <div class="flex">
            <?php if (!isset($_SESSION['admin']) && !isset($customer)): ?>
                <a href="/Site1/login" class="btn cta">login</a>
            <?php elseif(isset($_SESSION['admin'])) :?>
                <a href="/Site1/admin/" class="btn">Dashboard</a>
                <a href="/Site1/logout" class="btn">Log Out</a>
            <?php else :?>
                <div class="dropdown cart">
                    <label class="">
                    <span>My Cart</span>
                    <input type="checkbox" class="dropdown-toggle">
                    </label>
                    <ul>
                        <?php if (isset($cart_items)): ?>
                            <?php $total = 0 ?>
                            <?php foreach($cart_items as $item): ?>
                                <?php
                                    $sql = "SELECT name, price, image FROM products WHERE id=$item[id]";
                                    $result = mysqli_query($conn, $sql);
                                    $product = $result->fetch_assoc();
                                ?>
                                <?php $total += ($product['price'] * $item['qty']) ?>
                                <li>
                                    <div class="cart-item">
                                        <img src="images/<?= (!empty($product['image'])) ? $product['image'] : 'placeholders/products.png'; ?>"
                                        width="64px" height="84px" alt="<?= $product['name']?>">
                                        <div class="cart-item-info">
                                            <h3><?= $product['name']?></h3>
                                            <small>
                                                <span class="cart-item-price">$<?= $product['price']?></span><span>Quantity: <?= $item['qty']?></span>
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                            <li class="checkout">
                                <span class="total">Total: $<?= $total ?></span>
                                <a href="/Site1/customer/cart" class="btn cta">View all items</a>
                            </li>
                        <?php else: ?>
                            <li>None</li>
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
                        <li>
                            <a href="./customer/wishlists">
                                <span>My Wishlists</span>
                                <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                        </li>
                        <li>
                            <a href="./customer/transactions">
                                <span>My transactions</span>
                                <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                        </li>
                        <li>
                            <a href="./customer/profile">
                                <span>My Profile</span>
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