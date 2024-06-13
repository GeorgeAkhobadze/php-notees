<?php require('partials/head.php'); ?>
<?php require('partials/nav.php'); ?>
<?php require('partials/banner.php'); ?>
<style>
    <?php include 'index.css'; ?>
    .get-post-id-btn {
        background-color: #f0f0f0; /* default color */
        color: #000;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    .get-post-id-btn.liked {
        background-color: #ff0000; /* liked color */
        color: #fff;
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
                            <p class="post-date">
                                <?php
                                $created_at = new DateTime($post['created_at']);
                                echo $created_at->format('d M Y H:i');
                                ?>
                                <?php if ($post['updated_at']) : ?>(edited) <?php endif ?>
                            </p>
                        </div>
                        <?php if (isset($post['image'])) : ?>
                            <img src="/storage?name=<?= $post['image'] ?>" class="post-image" alt="" />
                        <?php endif; ?>
                        <p class="post-description">
                            <?= $post['body'] ?>
                        </p>
                        <div class="like-section">
                            <button class="get-post-id-btn" data-note-id="<?= $post['id'] ?>" data-liked="<?= $post['liked'] ? 'true' : 'false' ?>" data-like-count=<?= $post['likeCount'] ?>>Like</button>
                            <div><?= $post['likeCount']?> Likes</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div>Sign up or Log in to view posts</div>
            <?php endif ?>
        </div>
    </div>
    <script type="module" src="js/note/like.js"></script>
</main>
<?php require('partials/footer.php'); ?>
