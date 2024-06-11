const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const chatMessagesDiv = document.getElementById('chat-messages');
const sendButton = document.getElementById("send-message");
const chatInput = document.getElementById("chat-input");
const joinButton = document.getElementById('join-chatroom');

let isMember = null;
let messagesInterval = null;
let lastMessageTimestamp = null;

function getMessages(date) {
    console.log(date)

    axios.get('/message', {
        params: { chatroomId: id, date },
        headers: { 'Content-Type': 'application/json' }
    })
        .then(handleResponse)
        .catch((error) => console.error(error));
}

function handleResponse(res) {
    const { messages, userId } = res.data;
    console.log(messages)
    isMember = Boolean(messages);
    lastMessageTimestamp = messages[0]['created_at'];


    if (isMember && chatMessagesDiv) {
        chatMessagesDiv.innerHTML = '';
        renderMessages(messages.reverse(), userId);
        chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;

        if (!messagesInterval && lastMessageTimestamp) {
            messagesInterval = setInterval(() => getMessages(lastMessageTimestamp), 5000);

        }
    } else if (messagesInterval) {
        clearInterval(messagesInterval);
        messagesInterval = null;
    }
}

function sendMessage() {
    const message = chatInput.value.trim();
    if (message.length > 0) {
        axios.post('/message', { message, chatroomId: id })
            .then(getMessages)
            .catch(error => console.error(error));
        chatInput.value = '';
    }
}

function renderMessages(messages, userId) {
    messages.forEach(messageContent => {
        const messageDiv = createMessageDiv(messageContent, userId);
        chatMessagesDiv.appendChild(messageDiv);
    });
}

function createMessageDiv(messageContent, userId) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('chat-message', messageContent.user_id === userId ? 'user' : 'other');

    if (messageContent.user_id !== userId) {
        const userInfoDiv = createUserInfoDiv(messageContent);
        messageDiv.appendChild(userInfoDiv);
    }

    const messageContentDiv = document.createElement('div');
    messageContentDiv.classList.add('message-content');
    messageContentDiv.textContent = messageContent.message;
    messageDiv.appendChild(messageContentDiv);

    return messageDiv;
}

function createUserInfoDiv(messageContent) {
    const userInfoDiv = document.createElement('div');
    userInfoDiv.classList.add('user-info');

    const usernameDiv = document.createElement('div');
    usernameDiv.classList.add('username');
    usernameDiv.textContent = messageContent.username;
    userInfoDiv.appendChild(usernameDiv);

    const userImage = document.createElement('img');
    userImage.classList.add('user-image');
    userImage.src = `/storage?name=${messageContent.userImage}`;
    userImage.alt = `${messageContent.username}'s profile picture`;
    userInfoDiv.appendChild(userImage);
    return userInfoDiv;
}

sendButton?.addEventListener("click", sendMessage);

function joinChatroom() {
    axios.post('/chat', { chatroomId: id })
        .then(() => location.reload())
        .catch(err => alert(err));
}

joinButton?.addEventListener('click', joinChatroom);

getMessages();
