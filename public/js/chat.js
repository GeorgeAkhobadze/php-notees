const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const chatMessagesDiv = document.getElementById('chat-messages');
const sendButton = document.getElementById("send-message")
const chatInput = document.getElementById("chat-input")
const joinButton = document.getElementById('join-chatroom')

let isMember = null;

function getMessages() {
    axios.get('/message', {
        params: {
            chatroomId: id
        }
    }, {
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(res => {
            isMember = Boolean(res.data.messages);

            if (isMember) {
                if (chatMessagesDiv) {
                    chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;
                    const data = res.data;
                    chatMessagesDiv.innerHTML = '';
                    data.messages.reverse().forEach(messageContent => {
                        const messageDiv = document.createElement('div');
                        if (data.userId === messageContent.user_id) {
                            messageDiv.classList.add('chat-message', 'user');
                        } else {
                            messageDiv.classList.add('chat-message', 'other');
                        }

                        const messageContentDiv = document.createElement('div');
                        messageContentDiv.classList.add('message-content');
                        messageContentDiv.textContent = messageContent.message;

                        messageDiv.appendChild(messageContentDiv);
                        chatMessagesDiv.appendChild(messageDiv);
                    });
                }

                if (!window.messagesInterval) {
                    window.messagesInterval = setInterval(getMessages, 1000);
                }
            } else {
                if (window.messagesInterval) {
                    clearInterval(window.messagesInterval);
                    window.messagesInterval = null; // Ensure the interval reference is cleared
                }
            }
        })
        .catch(error => console.error(error));
}

function sendMessage() {
    if(chatInput.value.trim().length > 0) {
        axios.post('/message', {
            message: chatInput.value,
            chatroomId: id
        }).then(() => {
            getMessages();
        })
        chatInput.value = '';
    }
}

if(sendButton) {
    sendButton.addEventListener("click", function() {
        sendMessage();
    })
}

function joinChatroom() {
    axios.post('/chat', {
        chatroomId: id
    }).then(res => {
        location.reload();
    }).catch(err => alert(err));
}

joinButton?.addEventListener('click', function () {
    joinChatroom();
})

getMessages();

