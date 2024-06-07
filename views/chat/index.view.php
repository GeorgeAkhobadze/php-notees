<?php require base_path('views/partials/head.php') ?>
<style>

    .chat-container {
        width: 90%;
        max-width: 600px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        height: 80vh;
    }

    .chat-header {
        padding: 20px;
        background: #007bff;
        color: #ffffff;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        text-align: center;
    }

    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        border-bottom: 1px solid #dddddd;
    }

    .chat-message {
        margin-bottom: 10px;
        display: flex;
    }

    .chat-message .message-content {
        max-width: 70%;
        padding: 10px;
        border-radius: 10px;
        position: relative;
        word-wrap: break-word;
    }

    .chat-message.user .message-content {
        background: #007bff;
        color: #ffffff;
        margin-left: auto;
    }

    .chat-message.user .message-content::after {
        content: '';
        position: absolute;
        right: -10px;
        top: 10px;
        border-width: 10px 0 10px 10px;
        border-style: solid;
        border-color: transparent transparent transparent #007bff;
    }

    .chat-message.other .message-content {
        background: #e0e0e0;
        color: #000000;
        margin-right: auto;
    }

    .chat-message.other .message-content::after {
        content: '';
        position: absolute;
        left: -10px;
        top: 10px;
        border-width: 10px 10px 10px 0;
        border-style: solid;
        border-color: transparent #e0e0e0 transparent transparent;
    }

    .chat-input {
        display: flex;
        padding: 20px;
        background: #f9f9f9;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .chat-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        margin-right: 10px;
        font-size: 16px;
    }

    .chat-input button {
        padding: 10px 20px;
        background: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background: #0056b3;
    }
    header {
        display: flex;
    }
</style>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<main style="padding-top: 16px">
    <div class="chat-container" style="margin: 0 auto">
        <div class="chat-messages" id="chat-messages">
        </div>
        <div class="chat-input">
            <input aria-label="chat-input" type="text" id="chat-input" placeholder="Type a message...">
            <button id="send-message">Send</button>
        </div>
    </div>

    <script src="js/chat.js"></script>
</main>

<?php require base_path('views/partials/footer.php') ?>
