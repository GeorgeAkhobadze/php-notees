<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <div class="flex min-h-full flex-col justify-start px-6 py-12 lg:px-8">
            <div style="position: relative">
                <img style="width: 128px; height: 128px; border-radius: 100px; object-fit: cover" alt="" src="/storage?name=<?= $user['image'] ?>"/>
                <form method="POST" id="profile-form" enctype="multipart/form-data">
                    <input name="profilePicture" id="profilePictureInput" type="file" hidden="hidden"/>
                    <button id="change-picture">
                        <img alt="edit" src="/storage?name=edit-image.svg"/>
                    </button>
                </form>
            </div>
            <?php if (isset($errors['image'])) : ?>
                <p class="text-red-500 text-xs mt-2"><?= $errors['image'] ?></p>
            <?php endif; ?>
            <h1>Profile</h1>
            <p><b>Username:</b> <?= $user['username'] ?></p>
            <p><b>Email:</b> <?= $user['email'] ?></p>
            <p><b>Date Joined:</b> <?= date("d.m.Y", strtotime($user['created_at'])) ?></p>
        </div>
    </div>
    <script src="js/profileEdit.js"></script>

<?php require base_path('views/partials/footer.php') ?>