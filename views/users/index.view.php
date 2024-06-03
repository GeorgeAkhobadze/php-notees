<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <ul>
                <?php foreach ($users as $user) : ?>
                    <li>
                        <a href="/user?id=<?= $user['id'] ?>">
                            <?php echo($user['username']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
<?php require base_path('views/partials/footer.php') ?>