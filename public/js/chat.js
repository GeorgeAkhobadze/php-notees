const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const chatMessagesDiv = document.getElementById('chat-messages');
const sendButton = document.getElementById("send-message");
const chatInput = document.getElementById("chat-input");
const joinButton = document.getElementById('join-chatroom');

let isMember = null;
let messagesInterval = null;

function getMessages() {
    axios.get('/message', {
        params: { chatroomId: id },
        headers: { 'Content-Type': 'application/json' }
    })
        .then(res => {
            const { messages, userId } = res.data;
            isMember = Boolean(messages);

            if (isMember && chatMessagesDiv) {
                chatMessagesDiv.innerHTML = '';
                messages.reverse().forEach(messageContent => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('chat-message', messageContent.user_id === userId ? 'user' : 'other');

                    if(messageContent.user_id !== userId) {
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

                        messageDiv.appendChild(userInfoDiv);
                    }

                    const messageContentDiv = document.createElement('div');
                    messageContentDiv.classList.add('message-content');
                    messageContentDiv.textContent = messageContent.message;
                    messageDiv.appendChild(messageContentDiv);

                    chatMessagesDiv.appendChild(messageDiv);
                });
                chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;

                // if (!messagesInterval) {
                //     messagesInterval = setInterval(getMessages, 1000);
                // }
            } else if (messagesInterval) {
                clearInterval(messagesInterval);
                messagesInterval = null;
            }
        })
        .catch(error => console.error(error));
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

sendButton?.addEventListener("click", sendMessage);

function joinChatroom() {
    axios.post('/chat', { chatroomId: id })
        .then(() => location.reload())
        .catch(err => alert(err));
}

joinButton?.addEventListener('click', joinChatroom);

getMessages();
