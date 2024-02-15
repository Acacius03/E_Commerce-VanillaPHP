<section class="products-section">
    <h2>All Products</h2>
    <div class="products-filter">
        <select name="gender" id="gender">
            <option value=""  selected>Gender</option>
            <option value="Men">Men</option>
            <option value="Women">Women</option>
        </select>
        <select name="category" id="category">
            <option value=""  selected>Category</option>
        </select>
        <select name="price" id="price">
            <option value=""  selected>Price</option>
        </select>
        <label for="products-search" class="btn">
            <input type="text" id="products-search">
            <span class="">Search</span>
        </label>
    </div>
    <div class="products-list">
        <?php foreach ($products as $product) : ?>
            <a class="product" href="customer/cart/add.php?id=<?= $product['id']?>" >
                <img src="images/<?= (!empty($product['image'])) ? $product['image'] : 'placeholders/products.png'; ?>" height="120px" alt="<?= $product['name'] ?>">
                <div class="product-info">
                    <p class="product-name"><?= $product['name'] ?></p>
                    <p class="product-price">$<?= $product['price'] ?></p>
                    <small><span class="product-gender"><?= $product['sex'] ?></span>'s <span class="product-category"><?= $product['tag'] ?></span></small>
                    <!-- <small>1 Color</small> -->
                </div>
            </a>
        <?php endforeach ?>      
    </div>
</section>