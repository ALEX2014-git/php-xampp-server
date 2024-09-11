<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница заявок</title>
    <link rel="stylesheet" href="services.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function checkForUpdates() {
    $.ajax({
        url: 'check_updates.php',
        method: 'GET',
        success: function(response) {
            console.log('Ответ от сервера:', response);
            if (response.updates && Array.isArray(response.updates)) {
                response.updates.forEach(function(update) {
                    console.log('Обновление:', update); // Логируем каждое обновление
                    const ticketElement = $('.ticket[data-id="' + update.ticket_id + '"]');
                    if (ticketElement.length) {
                        ticketElement.find('.ticket-status').text('Статус: ' + update.status);
                    } else {
                        console.log('Элемент заявки не найден для ID:', update.ticket_id);
                    }
                });
            } else {
                console.log('Нет обновлений или формат данных неверный');
            }
            setTimeout(checkForUpdates, 5000);
        },
        error: function(xhr, status, error) {
            console.error('Произошла ошибка при проверке обновлений:', error);
            setTimeout(checkForUpdates, 10000);
        }
    });
}

$(document).ready(function() {
    checkForUpdates();
});


    $(document).ready(function() {
	checkForUpdates();
    $(document).on('click', '.delete-ticket', function() {
        var ticketId = $(this).data('id');
        // Отправка AJAX запроса на сервер для удаления заявки
        $.ajax({
            url: 'process_ticket.php',
            method: 'POST',
            data: {
                action: 'delete_ticket',
                ticket_id: ticketId
            },
            success: function(response) {
                console.log('Заявка удалена');
                // Удаляем контейнер заявки из DOM
                $('.ticket[data-id="' + ticketId + '"]').remove();
            },
            error: function(xhr, status, error) {
                console.error('Произошла ошибка при удалении заявки');
            }
        });
    });
});



   $(document).on('click', '.dropdown-toggle', function(event) {
        event.preventDefault();
        // Закрываем другие открытые меню
        $('.dropdown-menu').not($(this).next()).removeClass('show');
        // Переключаем отображение текущего меню
        $(this).next('.dropdown-menu').toggleClass('show');
    });

    // Закрываем dropdown-меню при клике вне его области
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });

    // Обрабатываем выбор элемента из dropdown-меню
    $(document).on('click', '.dropdown-item', function(event) {
        event.preventDefault();
        var selectedStatus = $(this).text();
		var ticketId = $(this).closest('.ticket').data('id');

        // Отправка AJAX запроса на сервер для обновления статуса
        $.ajax({
            url: 'process_ticket.php',
            method: 'POST',
            data: {
                action: 'change_status',
                ticket_id: ticketId,
                status: selectedStatus
            },
            success: function(response) {
				 console.log('Ответ сервера: ' + response);
                console.log('Статус заявки изменен на: ' + selectedStatus);
                // Обновляем отображение статуса на странице
                $('.ticket[data-id="' + ticketId + '"] .ticket-status').text('Статус: ' + selectedStatus);
            },
            error: function(xhr, status, error) {
				console.error('Ошибка запроса: ' + error);
                console.error('Произошла ошибка при изменении статуса заявки');
            }
        });
    });
</script>
  <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .unique-container {
            flex: 1;
        }
        .auth-message {
            text-align: center;
            font-size: 24px; /* Увеличенный размер шрифта */
            margin-top: 20px; /* Отступ сверху */
        }
        footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
	<?php include 'chattest.php'; ?>
    <div class="container">
        <?php
        // Проверка авторизации пользователя
        if (!isset($_SESSION['username'])) {
          echo '<p class="auth-message">Пожалуйста, авторизируйтесь для просмотра этого контента.</p>';
        } else {
            // Код для отображения списка заявок, если пользователь авторизован
            echo '<div id="tickets-container"></div>';
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="services_script.js"></script>
	
  <footer>
        <div class="unique-contact-info">
            <p>Контактная информация МФЦ:</p>
            <p>Телефон: 8 (800) 123-45-67</p>
            <p>Email: info@mfc.ru</p>
        </div>
        <div class="unique-social-links">
            <p>Следите за нами в социальных сетях:</p>
            <a href="#">VK</a>
            <a href="#">Telegram</a>
            <a href="#">Одноклассники</a>
        </div>
        <p>&copy; 2024 Корпоративный портал технической поддержки МФЦ</p>
    </footer>
</body>
</html>