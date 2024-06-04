<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="flex min-h-full flex-col justify-start px-6 py-12 lg:px-8">
            <h1>Profile</h1>
            <p><b>Username:</b> <?= $user[0]['username'] ?></p>
            <p><b>Email:</b> <?= $user[0]['email'] ?></p>
            <p><b>Date Joined:</b> <?= date("d.m.Y", strtotime($user[0]['created_at'])) ?></p>
        </div>
    </div>

<?php require base_path('views/partials/footer.php') ?>