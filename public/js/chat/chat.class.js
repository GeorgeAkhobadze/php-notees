
class Chat {
    constructor() {
        this.messagesArray = [];
        this.lastMessageTimestamp = null;
        this.userId = null;
    }

    sendMessage(message, chatroomId) {
        let _this = this
        message.trim();

        if (message.length > 0) {
            return axios.post('/message', { message, chatroomId })
                .then((res) => {

                    return _this.getMessages(chatroomId, this.lastMessageTimestamp);
                })
                .catch(error => console.error(error));
        }
    }

    getMessages(chatroomId, date = undefined, isLastMessage = false) {
        let _this = this
        return axios.get('/message', {
            params: { chatroomId , date: date, isLastMessage: isLastMessage },
            headers: { 'Content-Type': 'application/json' }
        })
            .then((res) => {
                if(res.data?.messages.length > 0) {
                    this.userId = res.data.userId
                    _this.handleResponse(res, isLastMessage, chatroomId)
                    return res.data.messages;
                }
            }).catch((error) => alert(error));
    }

    handleResponse(res, isLastMessage, chatroomId) {
        const { messages, userId } = res.data;

        if(isLastMessage) {
            this.messagesArray = [...this.messagesArray, ...messages]
        } else {
            this.messagesArray = [...messages, ...this.messagesArray]
        }

        this.lastMessageTimestamp = this.messagesArray[0]['created_at'];
        return { messagesArray: this.messagesArray, userId };
    }

}

export default Chat;