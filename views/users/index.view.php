<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>


    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <ul>
                <?php foreach ($users as $user) : ?>
                    <li style="display: flex; gap: 12px;">
                        <p><b>id: </b><?= $user['id'] ?></p>
                        <a href="/user?id=<?= $user['id'] ?>">
                            <?php echo($user['username']) ?>
                        </a>
                        <?php foreach ($friends as $friend) : ?>
                            <?php if ($friend['user'] == $user['id'] || $friend['friend'] == $user['id']) : ?>
                                <?php if ($friend['status'] == 'pending' && $friend['friend'] == $currentUser['id']) : ?>
                                    <form method="POST" action="/users">
                                        <input type="hidden" value="<?= $friend['user']  ?>" name="id">
                                        <button>Confirm</button>
                                        <button name="_method" value="DELETE">Remove</button>
                                    </form>
                                <?php else : ?>
                                    <p>
                                        <b>Status: </b><?= $friend['status'] ?>
                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
<?php require base_path('views/partials/footer.php') ?>