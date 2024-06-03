<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<?php
$sender = isset($friendStatus) && $friendStatus !== false && $friendStatus['user'] !== $user['id'];
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/users" class="text-blue-500 underline mb-6">Go back</a>
        </p>

        <h2><b>Username: </b><?= htmlspecialchars($user['username']) ?></h2>
        <p><b>Email: </b><?= $user['email'] ?></p>
        <form method="POST" action=<?= "/user?id=" . $user['id']?>>
            <?php if ($sender && $friendStatus['status'] === 'pending') : ?>
                <button type="submit" name="_method" value="DELETE">Cancel Request</button>
            <?php elseif (!$sender && !$friendStatus) : ?>
                <button type="submit" class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Friend</button>
            <?php endif; ?>
        </form>
        <form method="POST" action=<?= "/user?id=" . $user['id']?>>
            <?php if ($friendStatus !== false && $friendStatus['user'] === $user['id'] && $friendStatus['status'] === 'pending') : ?>
                <button type="submit" name="_method" value="PATCH" class="text-green-500 text-xs mt-2">Accept</button>
                <button type="submit" name="_method" value="DELETE" class="text-red-500 text-xs mt-2">Decline</button>
            <?php endif; ?>
        </form>

        <?php if ($friendStatus && $friendStatus['status'] === 'accepted') : ?>
            <p><b>Friendship status: </b>Accepted</p>
        <form method="POST" action=<?= "/user?id=" . $user['id']?>>
            <button type="submit" name="_method" value="DELETE" class="text-red-500 text-xs mt-2">Unfriend</button>
        </form>
        <?php endif; ?>
    </div>


</main>
<?php require base_path('views/partials/footer.php') ?>
