<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 underline mb-6">Go back</a>
        </p>
        <h2><b>Username: </b><?= htmlspecialchars($user['username']) ?></h2>
        <p><?= $user['email'] ?></p>
        <button class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Friend</button>
        <footer class="mt-6">
            <a href="/note/edit?id=<?= $user['id'] ?>" class="text-gray-500 border border-current px-4 py-2 rounded">Edit</a>
        </footer>

    </div>
</main>
<?php require base_path('views/partials/footer.php') ?>
