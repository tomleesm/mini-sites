const websocketURL = 'ws://' + window.location.hostname + ':8080';
var ws = new WebSocket(websocketURL);

const ChatRoom = {
    // 輸入訊息的表單
    form: document.getElementById('form'),
    // 輸入訊息的 input
    input: document.getElementById('input'),
    // 聊天室訊息
    messages: document.getElementById('messages'),
    // 目前登入的使用者 id
    id: document.getElementById('user_id')
};
ChatRoom.addMessage = function(message) {
    // 把訊息加到聊天室結尾
    var item = document.createElement('li');
    item.textContent = message;
    this.messages.appendChild(item);
    // 視窗捲軸最底下
    window.scrollTo(0, document.body.scrollHeight);
}
ChatRoom.submitMessage = function() {
    this.form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (this.input.value) {
            const data = {
                userId: document.getElementById('user_id').value,
                message: this.input.value
            };
            console.log(data)
            ws.send(JSON.stringify(data));

            ChatRoom.addMessage(this.input.value);

            this.input.value = '';
        }
    });
}

ChatRoom.submitMessage();

ws.onopen = function() {
    console.log("Connection open");
}
ws.onmessage = function(event) {
    console.log( "Received message from server: " + event.data);

    ChatRoom.addMessage(event.data);
};
ws.onclose = function() {
    console.log("Connection closed.");
};
