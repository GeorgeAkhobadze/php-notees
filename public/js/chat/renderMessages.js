export function createMessageDiv(messageContent, userId) {
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

export function createUserInfoDiv(messageContent) {
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

export function renderMessages(messages, userId, chatMessagesDiv) {
    messages.forEach(messageContent => {
        const messageDiv = createMessageDiv(messageContent, userId);
        chatMessagesDiv.appendChild(messageDiv);
    });
}

