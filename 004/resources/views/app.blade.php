<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <script>
      var ws = new WebSocket('ws://192.168.56.10:8080');

      ws.onopen = function() {
        console.log("Connection open");

        ws.send('Tom');
      }
      ws.onmessage = function(event) {
        console.log( "Received message from server: " + event.data);
      };
      ws.onclose = function() {
        console.log("Connection closed.");
      };
    </script>
</body>
</html>
