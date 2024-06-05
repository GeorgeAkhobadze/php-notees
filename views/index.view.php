<?php require('partials/head.php'); ?>

  <?php require('partials/nav.php'); ?>

  <?php require('partials/banner.php'); ?>
    <style>
        <?php include 'index.css'; ?>
    </style>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="posts-container">
<?php if ($posts !== null) : ?>
            <?php foreach ($posts as $post) : ?>
            <div class="post">
                <div class="post-header">

                    <img class="post-author-img" src="/storage?name=<?= $post['userImage'] ?>">

                    <div class="post-author-name"><?= $post['username'] ?></div>
                    <p class="seperator-dot">•</p>
                    <p   class="post-date">05 Jun 2024 23:02 (edited)</p>
                </div>
                <?php if (isset($post['image'])) : ?>
                    <img src="/storage?name=<?= $post['image'] ?>" class="post-image" alt=""/>
                <?php endif; ?>
                <p class="post-description">
                    <?= $post['body'] ?>
                </p>
            </div>
            <?php endforeach; ?>
<?php else : ?>
<div>Sign up or Log in to view posts</div>
<?php endif ?>
        </div>

    </div>
  </main>
  <?php require('partials/footer.php'); ?>