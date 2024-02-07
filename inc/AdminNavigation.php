<nav class="dashboard-nav">
    <a href="/Site1/" class="branding">
        <img src="/Site1/images/logo-2.png" width="60px" height="60px" alt="Adidas">
        <span>Adidas</span>
    </a>
    <figure class="dashboard-photo">
        <img src="../../images/<?= (!empty(auth['avatar'])) ? auth['avatar'] : 'placeholders/avatar.jpg'; ?>" alt="<?= auth['last_name'] ?>, <?= auth['first_name'] ?>">
        <figcaption>
            <h3><?= auth['last_name'] ?>, <?= auth['first_name'] ?></h3>
            <small><?= auth['email'] ?></small>
        </figcaption>
    </figure>
    <div class="nav-links">
        <?php $url = explode("/", $_SERVER['REQUEST_URI']) ?>
        <?php foreach($links as $link): ?>
            <a href="/Site1/<?= auth['account_type'] ?>/<?= $link?>" 
            class="<?= (!in_array($link, $url)) ?: 'active';?>"><?= $link?></a>
        <?php endforeach ?>
        <a href="/Site1/<?= (auth['account_type'] == 'admin') ? 'logout' : '' ?>"><?= (auth['account_type'] == 'admin') ? 'log out' : 'home' ?></a>
    </div>
</nav>