<?php require('partials/head.php'); ?>

  <?php require('partials/nav.php'); ?>

  <?php require('partials/banner.php'); ?>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        Logged in user:
      <?= $_SESSION['user']['email'] ?? 'Guest' ?>
    </div>
  </main>
  <?php require('partials/footer.php'); ?>