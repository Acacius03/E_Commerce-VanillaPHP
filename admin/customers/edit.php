<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';
    $title = 'Admin | Customers';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = 'SELECT * FROM users WHERE id='.$_GET['id'];
        $result = mysqli_query($conn, $sql);
        $customer = $result->fetch_assoc();
    }
    if (isset($_POST['submit'])) {
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password_confirm = filter_input(INPUT_POST, 'password_confirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($first_name) || empty($last_name)) {die('Name is required');}
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {die('Valid Email is required');}

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $user = $result->fetch_assoc();

        if ($user && $user['id'] != $id) {die('Email is already taken');}
        if (!empty($password)){
            if (strlen($password) < 8) {die('Password must be at least 8 characters');}
            if (!preg_match("/[a-z]/i", $password)) {die('Password must contain at least one letter');}
            if (!preg_match("/[0-9]/i", $password)) {die('Password must contain at least one number');}
            if ($password != $password_confirm) {die('Password must match'.$password.'    '.$password_confirm);}
        }
        if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($sex) ) {
            $image = '';
            if (!empty($_FILES['image']['name'])) {
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                
                $file = explode('.', $file_name);
                $file_ext = strtolower(end($file));
                $image = $file[0] . "_" . time() . "." . $file_ext;
        
                $target_dir = "../../images/$image";
                $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');
                if  (in_array($file_ext, $allowed_ext) && $file_size <= 1000000) {
                    move_uploaded_file($file_tmp, $target_dir);
                }
            }
            if (!empty($password)){
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', sex='$sex', password='$password_hash', avatar='$image' where id=$id";
                mysqli_query($conn, $sql);
            } else {
                $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', sex='$sex', avatar='$image' where id=$id";
                mysqli_query($conn, $sql);
            }
            header("LOCATION: ./");
            exit;
        };
    };
    include_once '../../inc/Head.php';
    include_once '../../inc/AdminNavigation.php' ?>
<main>
    <header>
        <h3 class="page-title">Customers: Edit a Customer</h3>
    </header>
    <div class="container">
        <a href="./" class="btn">Back</a>
        <form method="POST" enctype="multipart/form-data" class="form">
            <div>
                <div class="info">
                    <div class="form-input">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" autocomplete='off' value="<?php echo $customer['first_name'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" autocomplete='off'  value="<?php echo $customer['last_name'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" autocomplete='off'  value="<?php echo $customer['email'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="sex">Sex:</label>
                        <select type="text" name="sex" id="sex">
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-input">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                <label for="image" class="image">
                    <img src="../../images/<?= (!empty($customer['avatar'])) ? $customer['avatar'] : 'placeholders/avatar.jpg'; ?>" class="image-preview" width="240px" height="240px" alt="Click to add Image">
                    <input type="file" name="image" id="image" accept='image/jpeg, image/png' style="display:none" onchange="previewImage()">
                </label>
            </div>
            <input class="submit-btn" type="submit" value="Submit" name="submit">
        </form>
    </div>
</main>
<?php include_once '../../inc/Footer.php'; ?>
