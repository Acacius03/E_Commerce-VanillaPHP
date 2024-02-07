<?php 
include_once '../authentication.php';
include_once '../../config/database.php';
if (isset($_GET['id'])) {
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
    $sql = 'DELETE FROM products WHERE id='.$_GET['id'];
    mysqli_query($conn, $sql);
    header("LOCATION: $_SERVER[HTTP_REFERER]");
}
