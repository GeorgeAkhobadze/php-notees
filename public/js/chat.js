const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const chatMessagesDiv = document.getElementById('chat-messages');
const sendButton = document.getElementById("send-message")
const chatInput = document.getElementById("chat-input")

function getMessages() {
    axios.get('/test', {
        params: {
            chatroomId: id
        }
    }, {
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(res => {
            chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;
            const data = res.data;
            chatMessagesDiv.innerHTML = '';
            data.messages.reverse().forEach(messageContent => {
                const messageDiv = document.createElement('div');
                if(data.userId === messageContent.user_id) {
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
        })
        .catch(error => console.error(error));
}


getMessages();
setInterval(getMessages, 1000)

function sendMessage() {
    if(chatInput.value.trim().length > 0) {
        axios.post('/test', {
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


