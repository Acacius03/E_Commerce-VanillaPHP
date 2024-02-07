<form action="create.php" method="POST" enctype="multipart/form-data" class="form">
    <div>
        <div class="info">
            <div class="form-input">
                <label for="id">Product ID:</label>
                <input type="number" name="id" id="id" value="<?= $next_product_id ?>" autocomplete="off" disabled>
            </div>
            <div class="form-input">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" autocomplete="off">
            </div>
            <div class="form-input">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" autocomplete="off">
            </div>
            <div class="form-input">
                <label for="stocks">Stocks:</label>
                <input type="number" name="stocks" id="stocks" autocomplete="off">
            </div>
            <div class="form-input">
                <label for="tag">Tag:</label>
                <input type="text" name="tag" id="tag" autocomplete="off">
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
                <textarea type="text" name="description" id="description"></textarea>
            </div>
        </div>
        <label for="image" class="image">
            <img src="../../images/placeholders/products.png" class="image-preview" width="240px" height="240px" alt="Click to add Image">
            <input type="file" name="image" id="image" accept='image/jpeg, image/png' style="display:none" onchange="previewImage('#image','.image-preview')">
        </label>
    </div>
    <input class="submit-btn" type="submit" value="Submit" name="submit">
</form>