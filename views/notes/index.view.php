<?php require base_path('views/partials/head.php') ?>
<style>

    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
    }

    .content-wrapper {
        max-width: 700px;
        margin: 0 auto;
        padding: 2rem;
    }

    .notes-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .note-item {
        margin-bottom: 1rem;
    }

    .note-link {
        color: #333;
        text-decoration: none;
        display: block;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        transition: background-color 0.2s ease-in-out;
    }

    .note-link:hover {
        background-color: #eee;
        text-decoration: none;
    }

    .create-note {
        margin-top: 1rem;
        text-align: center;
    }

    .create-note-link {
        color: #2980b9;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.2s ease-in-out;
    }

    .create-note-link:hover {
        color: #1a759f;
    }


</style>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>


<main>
    <div class="content-wrapper" style="
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: column;
">  <ul class="notes-list">
            <?php foreach ($notes as $note) : ?>
                <li class="note-item">
                    <a href="/note?id=<?= $note['id'] ?>" class="note-link">
                        <?php echo($note['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

            <a href="/notes/create" style="align-self: center" class="rounded-md bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Note</a>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
