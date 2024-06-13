import { renderMessages } from '/js/chat/renderMessages.js';
import Chat from "/js/chat/chat.class.js";

const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const chatMessagesDiv = document.getElementById('chat-messages');
const chatMessagesContainer = document.getElementById('chat-messages-wrapper');
const sendButton = document.getElementById("send-message");
const chatInput = document.getElementById("chat-input");

const chatClass = new Chat();

async function initializeChat() {
    try {
        await chatClass.getMessages(id);
        renderMessages(chatClass.messagesArray, chatClass.userId, chatMessagesDiv);

        if (chatClass.messagesArray?.[0]?.created_at) {
            setInterval(() => chatClass.getMessages(id, chatClass.messagesArray[0].created_at).then(res => {
                renderMessages(res, chatClass.userId, chatMessagesDiv, true)
            }), 5000);
        }
    } catch (error) {
        console.error(error);
    }
}

function setupEventListeners() {
    sendButton?.addEventListener("click", () => chatClass.sendMessage(chatInput.value, id).then((res) => {
        chatInput.value = ''
        renderMessages(res, chatClass.userId, chatMessagesDiv, true)
    }));
    chatInput?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') chatClass.sendMessage(chatInput.value, id).then((res) => {
            chatInput.value = ''
            renderMessages(res, chatClass.userId, chatMessagesDiv, true)
        });
    });

    chatMessagesContainer?.addEventListener('scroll', () => {
        if (chatMessagesContainer.scrollTop === 0) {
            const lastMessageDate = chatClass.messagesArray[chatClass.messagesArray.length - 1].created_at;
            chatClass.getMessages(id, lastMessageDate, true).then((res) => {
                if (!res) {
                    document.getElementById('chat-end').style.display = 'flex';
                } else {
                    renderMessages(res, chatClass.userId, chatMessagesDiv);
                }

            });
        }
    });
}

initializeChat();
setupEventListeners();
