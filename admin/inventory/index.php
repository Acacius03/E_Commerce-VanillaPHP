<?php 
    include_once '../../config/database.php';
    include_once '../authentication.php';
    
    $title = 'Admin | Inventory';

    $next_product_id = 0;

    $sql = 'SELECT * FROM products';
    $result = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SHOW TABLE STATUS LIKE 'products'";
    $result = mysqli_query($conn, $sql);
    
    // Get next id for new product
    if ($result) {
        $row = $result->fetch_assoc();
        $next_product_id = $row['Auto_increment'];
    }
?>
<?php include_once '../../inc/Head.php'; ?>
<?php include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header>
        <h3 class="page-title">Inventory</h3>
    </header>
    <div id="modal" class="hidden">
        <div id="modal-overlay"></div>
        <div class="form-container">
            <h3 class="form-title">Add a Product</h3>
            <?php include_once 'products-form.php' ?>
        </div>
    </div>
    <div class="container">
        <div>
            <div class="table-tools">
                <div><input id="data-search" type="text" placeholder="Search Product Name"> <i class="fa-solid fa-magnifying-glass"></i></div>
                <button class="add-product-btn" onclick="openModal()"><i class="fa-solid fa-plus"></i> Add a Product</button>
            </div>
            <div class="table-container">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th class="name">Name</th>
                        <th class="price">Price</th>
                        <th class="stocks">Stocks</th>
                        <th>Description</th>
                        <th class="Sex">Sex</th>
                        <th class="tag">Tag</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($products as $product) : ?>
                        <tr class="data-row">
                            <td><?= $product['id'] ?></td>
                            <td><img src="../../images/<?= (!empty($product['image'])) ? $product['image'] : 'placeholders/products.webp'; ?>" height="120px"></td>
                            <td class="name"><?= $product['name'] ?></td>
                            <td class="price">$ <?= $product['price'] ?></td>
                            <td class="stocks"><?= $product['stocks'] ?> </td>
                            <td><?= $product['description'] ?></td>
                            <td class="sex"><?= $product['sex'] ?></td>
                            <td class="tag"><?= $product['tag'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $product['id'] ?>" class="table-item-action edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="delete.php?id=<?= $product['id'] ?>" class="table-item-action delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include_once '../../inc/Footer.php' ?>