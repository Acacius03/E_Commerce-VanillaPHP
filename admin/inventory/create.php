<?php 
include_once '../authentication.php';
include_once '../../config/database.php';
if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $stocks = filter_input(INPUT_POST, 'stocks', FILTER_SANITIZE_NUMBER_INT);
    $tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
    $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!empty($_POST['name']) && !empty($_POST['stocks']) && !empty($_POST['tag']) && !empty($_POST['price']) && !empty($_POST['sex'])) {
        // Upload Image
        $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            
            // Make New File Name
            $file = explode('.', $file_name);
            $file_ext = strtolower(end($file));
            $image = $file[0] . "_" . time() . "." . $file_ext;

            $target_dir = "../../images/$image";
            if  (in_array($file_ext, $allowed_ext) && $file_size <= 1000000) {
                move_uploaded_file($file_tmp, $target_dir);
            }
        }
        //add to database
        $sql = "INSERT INTO products (name, description, stocks, tag, price, sex, image) VALUES ('$name', '$description', $stocks, '$tag', $price, '$sex', '$image')";
        mysqli_query($conn, $sql);
        header("LOCATION: $_SERVER[HTTP_REFERER]");
    };
};
header("LOCATION: $_SERVER[HTTP_REFERER]");