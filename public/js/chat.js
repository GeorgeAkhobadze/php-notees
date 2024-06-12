const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const chatMessagesDiv = document.getElementById('chat-messages');
const chatMessagesContainer = document.getElementById('chat-messages-wrapper');
const sendButton = document.getElementById("send-message");
const chatInput = document.getElementById("chat-input");

let isMember = null;
let messagesInterval = null;
let lastMessageTimestamp = null;
let messagesArray = [];




function getMessages(date, isLastMessage = false) {
    axios.get('/message', {
        params: { chatroomId: id, date: date, isLastMessage },
        headers: { 'Content-Type': 'application/json' }
    })
        .then((res) => {
            if(res.data.messages.length > 0) {
                handleResponse(res, isLastMessage)
            }
        }).catch((error) => alert(error));
}

function handleResponse(res, isLastMessage) {
    const { messages, userId } = res.data;

    isMember = Boolean(messages);
    if(isLastMessage) {
        messagesArray = [...messagesArray, ...messages]
    } else {
        messagesArray = [...messages, ...messagesArray]
    }
    lastMessageTimestamp = messagesArray[0]['created_at'];

    if (isMember && chatMessagesDiv) {
        chatMessagesDiv.innerHTML = '';
        renderMessages(messagesArray, userId);

        chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

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
            .then(() => {
                getMessages(lastMessageTimestamp);
            })
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

chatInput?.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
});

function logScrolledAmount() {
    const scrolledAmount = chatMessagesContainer.scrollTop;
    if(scrolledAmount === 0) {
        const lastMessageDate = messagesArray[messagesArray.length - 1].created_at
        getMessages(lastMessageDate, true);
    }
}

chatMessagesContainer?.addEventListener('scroll', logScrolledAmount);

getMessages();
