<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';
    $title = 'Admin | Inventory';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = 'SELECT * FROM products WHERE id='.$_GET['id'];
        $result = mysqli_query($conn, $sql);
        $product = $result->fetch_assoc();
    }
    if (isset($_POST['submit'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $stocks = filter_input(INPUT_POST, 'stocks', FILTER_SANITIZE_NUMBER_INT);
        $tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
        $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['stocks']) && !empty($_POST['tag'])&& !empty($_POST['price']) && !empty($_POST['sex'])) {
            // Image Upload
            $image = '';
            if (!empty($_FILES['image']['name'])) {
                // Delete current Product Image
                $sql = 'SELECT image FROM products WHERE id='.$_GET['id'];
                $result = mysqli_query($conn, $sql);
                $image = $result->fetch_assoc();
                if (file_exists('../../images/'.$image['image'])){
                    if (unlink('../../images/'.$image['image'])){
                        echo 'Image Succesfully Deleted';
                    }
                } else {
                    echo 'Failed to delete image';
                }
                // Set new Product Image
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                
                $file = explode('.', $file_name);
                $file_ext = strtolower(end($file));
                $image = $file[0] . "_" . time() . "." . $file_ext;
        
                $target_dir = "../../images/$image";
                $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');
                if  (in_array($file_ext, $allowed_ext) && $file_size <= 2000000) {
                    move_uploaded_file($file_tmp, $target_dir);
                } else {
                    $image = '';
                }
            }

            $sql = "UPDATE products SET name='$name', description='$description', stocks=$stocks, tag='$tag', price=$price, sex='$sex', image='$image' where id=$id";
            mysqli_query($conn, $sql);
            header("LOCATION: index.php");
        };
    };
?>
<?php include_once '../../inc/Head.php'; ?>
<?php include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header>
        <h3 class="page-title">Inventory: Edit a Product</h3>
    </header>
    <div class="container">
        <a href="./" class="btn">Back</a>
        <form method="POST" enctype="multipart/form-data" class="form">
            <div>
                <div class="info">
                    <div class="form-input">
                        <label for="name">Product ID:</label>
                        <input type="number" name="id" id="id" value="<?= $product['id'] ?>" disabled>
                    </div>
                    <div class="form-input">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" autocomplete="off" value="<?= $product['name'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" autocomplete="off" value="<?= $product['price'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="stocks">Stocks:</label>
                        <input type="number" name="stocks" id="stocks" autocomplete="off" value="<?= $product['stocks'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="tag">Tag:</label>
                        <input type="text" name="tag" id="tag" autocomplete="off" value="<?= $product['tag'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="sex">Sex:</label>
                        <select type="text" name="sex" id="sex">
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>
                    <div class="description form-input">
                        <label for="description">Description:</label>
                        <textarea type="text" name="description" id="description" autocomplete="off"><?= $product['description'] ?></textarea>
                    </div>
                </div>
                <label for="image" class="image">
                    <img src="../../images/<?= (!empty($product['image'])) ? $product['image'] : 'placeholders/products.webp'; ?>" class="image-preview" width="240px" height="240px" alt="Click to add Image">
                    <input type="file" name="image" id="image" accept='image/jpeg, image/png' style="display:none" onchange="previewImage('#image', '.image-preview')">
                </label>
            </div>
            <input class="submit-btn" type="submit" value="Submit" name="submit">
        </form>
    </div>
</main>
<?php include_once '../../inc/Footer.php'; ?>
