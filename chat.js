$(document).ready(function () {
    const chatBox = $('#chat-box');
    const chatToggle = $('#chat-toggle');
    const chatHeader = $('#chat-header');
    const chatInput = $('#chat-input');
    const sendBtn = $('#send-btn');
    const chatBody = $('#chat-body');
    const chatFooter = $('#chat-footer');

    function checkAuth() {
        $.get('check_auth.php', function (data) {
            if (data.authenticated) {
                loadMessages();
                chatFooter.show();
            } else {
                chatFooter.hide();
                chatBody.html('<p>Вы не авторизованы. Пожалуйста, войдите в систему, чтобы использовать чат.</p>');
            }
        }, 'json');
    }

    function loadMessages() {
        $.get('load_messages.php', function (data) {
            chatBody.html('');
            data.messages.forEach(function (message) {
                const messageElement = `
                    <div class="message">
                        <strong>${message.username}</strong>
                        <span class="message-text">${message.message}</span>
                        <small>${message.timestamp}</small>
                    </div>`;
                chatBody.append(messageElement);
            });
            scrollToBottom();
        }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
            console.error('Ошибка при загрузке сообщений:', textStatus, errorThrown);
        });
    }

    function scrollToBottom() {
        chatBody.scrollTop(chatBody.prop("scrollHeight"));
    }

    function toggleChat() {
        chatBox.toggle();
        if (chatBox.is(':visible')) {
            chatToggle.hide();
            scrollToBottom();
        } else {
            chatToggle.show();
        }
    }

    function sendMessage() {
        const message = chatInput.val();
        if (message.trim() !== '') {
            $.post('send_message.php', { message: message }, function (data) {
                if (data.success) {
                    chatInput.val('');
                    loadMessages();
                } else {
                    alert(data.error);
                }
            }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
                console.error('Ошибка при отправке сообщения:', textStatus, errorThrown);
                console.error('Ответ:', jqXHR.responseText);
            });
        }
    }

    function startMessagePolling() {
        setInterval(loadMessages, 5000); // Обновление каждые 5 секунд
    }

    chatToggle.on('click', function () {
        toggleChat();
    });

    chatHeader.on('click', function () {
        toggleChat();
    });

    sendBtn.on('click', function () {
        sendMessage();
    });

    chatInput.on('keypress', function (e) {
        if (e.which == 13) { // Enter key pressed
            sendMessage();
        }
    });

    checkAuth();
    startMessagePolling(); // Запуск периодического обновления сообщений
});
