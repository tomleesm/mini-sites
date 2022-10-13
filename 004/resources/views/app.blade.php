<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
      body { margin: 0; padding-bottom: 3rem; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }

      #form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; position: fixed; bottom: 0; left: 0; right: 0; display: flex; height: 3rem; box-sizing: border-box; backdrop-filter: blur(10px); }
      #input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
      #input:focus { outline: none; }
      #form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages > li { padding: 0.5rem 1rem; }
      #messages > li:nth-child(odd) { background: #efefef; }
    </style>
</head>
<body>
    <ul id="messages"></ul>
    <form id="form" action="">
      <input id="input" autocomplete="off" /><button>Send</button>
    </form>

    <script>
      var ws = new WebSocket('ws://192.168.56.10:8080');

      const ChatRoom = {
          // 輸入訊息的表單
          form: document.getElementById('form'),
          // 輸入訊息的 input
          input: document.getElementById('input'),
          // 聊天室訊息
          messages: document.getElementById('messages')
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
            ws.send(this.input.value);

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

    </script>
</body>
</html>
