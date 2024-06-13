<?php require base_path('views/partials/head.php') ?>
<style>
    .container {
        width: 90%;
        max-width: 600px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        box-sizing: border-box;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .chatroom-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .chatroom-item {
        margin-bottom: 15px;
    }

    .chatroom-link {
        text-decoration: none;
        color: inherit;
        display: block;
        padding: 15px;
        border-radius: 6px;
        transition: background 0.3s, box-shadow 0.3s;
    }

    .chatroom-link:hover {
        background: #f7f7f7;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .chatroom-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chatroom-info h2 {
        margin: 0 0 5px 0;
        font-size: 18px;
        color: #333;
    }

    .chatroom-info p {
        margin: 0;
        font-size: 14px;
        color: #666;
    }

    .user-item {
        width: 24px;
        height: 24px;
        display: flex;
        position: relative;
    }

    .user-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 100px;
    }

    .user-item .user-image:nth-child(2) {
    position: absolute;
        left: 16px;
    }
    .user-item .user-image:nth-child(3) {
        position: absolute;
        left: 32px;
    }

</style>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main style="display: flex; align-items: center; justify-content: center; padding-top: 16px">
    <div class="container">
        <ul class="chatroom-list">
            <?php foreach ($chatrooms as $chatroom) : ?>
                <li class="chatroom-item">
                    <a href="/chat?id=<?= $chatroom['chatroom_id'] ?>" class="chatroom-link">
                        <div class="chatroom-info">
                            <h2><?= $chatroom['chatroom_name'] ?></h2>
                            <div class="user-list">

                                    <p><?= $chatroom['total_members'] ?> Members</p>
                                <div class="user-item">
                                    <?php
                                    $usernames = explode(',', $chatroom['users']);
                                    $userImages = explode(',', $chatroom['user_images']);
                                    foreach ($userImages as $index => $image): ?>
                                        <img src="/storage?name=<?= $image ?>" alt="<?= $usernames[$index] ?>" class="user-image">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>


<?php require base_path('views/partials/footer.php') ?>
