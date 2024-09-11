<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Widget</title>
    <link rel="stylesheet" href="chat.css">
	    <script>
        console.log('JavaScript загружен и готов к работе');
    </script>
</head>
<body>
    <div id="chat-box" class="chat-box">
        <div id="chat-header" class="chat-header">Чат</div>
        <div id="chat-body" class="chat-body"></div>
        <div id="chat-footer" class="chat-footer">
            <textarea id="chat-input" placeholder="Введите сообщение..."></textarea>
            <button id="send-btn">Отправить</button>
        </div>
    </div>
    <button id="chat-toggle" class="chat-toggle">Открыть чат</button>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
        console.log('jQuery загружен:', typeof jQuery !== 'undefined'); // Проверка, что jQuery загружен
    </script>
    <script src="chat.js"></script>
</body>
</html>
