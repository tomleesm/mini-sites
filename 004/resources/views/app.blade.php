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

      var form = document.getElementById('form');
      var input = document.getElementById('input');
      var messages = document.getElementById('messages');

      ws.onopen = function() {
        console.log("Connection open");
      }
      ws.onmessage = function(event) {
        console.log( "Received message from server: " + event.data);

        var item = document.createElement('li');
        item.textContent = event.data;
        messages.appendChild(item);
        window.scrollTo(0, document.body.scrollHeight);
      };
      ws.onclose = function() {
        console.log("Connection closed.");
      };

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (input.value) {
          ws.send(input.value);

          var item = document.createElement('li');
          item.textContent = input.value;
          messages.appendChild(item);
          window.scrollTo(0, document.body.scrollHeight);

          input.value = '';
        }
      });
    </script>
</body>
</html>
