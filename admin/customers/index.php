<?php 
    include_once '../authentication.php';
    include_once '../../config/database.php';
    $title = 'Admin | Customers';

    $sql = "SELECT * FROM users where account_type='customer'";
    $result = mysqli_query($conn, $sql);
    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    include_once '../../inc/Head.php';
    include_once '../../inc/AdminNavigation.php'
?>
<main>
    <header><h3 class="page-title">Customers</h3></header>
    <div class="container">
        <div>
            <div class="table-tools">
                <div><input id="data-search" type="text" placeholder="Search User"><i class="fa-solid fa-magnifying-glass"></i></div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="sex">Sex</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer) : ?>
                            <tr class="data-row">
                                <td><img src="../../images/<?= (!empty($customer['avatar'])) ? $customer['avatar'] : 'placeholders/avatar.jpg'; ?>" width="80px" height="80px"></td>
                                <td class="name"><?= $customer['last_name'] ?>, <?= $customer['first_name'] ?></td>
                                <td><?= $customer['email'] ?></td>
                                <td class="sex"><?= $customer['sex'] ?></td>
                                <td>
                                    <a href="delete.php?id=<?= $customer['id'] ?>" class="table-item-action delete"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include_once '../../inc/Footer.php'; ?>
