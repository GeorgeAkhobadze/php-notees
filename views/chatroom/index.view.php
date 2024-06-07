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

</style>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>


<main style="display: flex; align-items: center; justify-content: center; padding-top: 16px">
    <div class="container">
        <ul class="chatroom-list">
            <?php foreach ($chatrooms as $chatroom) : ?>
            <li class="chatroom-item">
                <a href="/chat?id=<?= $chatroom['id'] ?>" class="chatroom-link">
                    <div class="chatroom-info">
                        <h2><?= $chatroom['name'] ?></h2>
                        <p><?= $chatroom['description'] ?></p>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
