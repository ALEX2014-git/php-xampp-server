<?php
session_start();

// Предположим, что имя пользователя хранится в переменной сессии 'username'
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Получаем текущую дату в формате YYYY-MM-DD
date_default_timezone_set('Europe/Moscow');
$current_date = date('Y-m-d');

// Проверка, авторизован ли пользователь
$is_authorized = !empty($username);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма отправки заявки</title>
    <link rel="stylesheet" href="form.css">
	<link rel="stylesheet" href="header.css">
</head>
<body>
    <?php include 'header.php'; ?>
	<?php include 'chattest.php'; ?>
	      <main class="main-content">
        <div class="ticket-form-container">
            <h1 class="ticket-form-title">Отправка заявки</h1>
            <form id="ticket-form" method="POST" action="submit_ticket.php">
                <div class="form-group">
                    <label for="date">Дата:</label>
                    <input type="text" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Наименование:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea id="description" name="description" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label for="type">Тип заявки:</label>
                    <select id="type" name="type" required>
                        <option value="Внутриорганизационная">Внутриорганизационная</option>
                        <option value="Клиентоориентированная">Клиентоориентированная</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" id="submit-btn" class="form_button">Отправить</button>
                </div>
            </form>
		<div id="message"></div>
        </div>



   <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('ticket-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Предотвращаем стандартное поведение отправки формы

                // Проверяем, авторизован ли пользователь
                var isAuthorized = "<?php echo $is_authorized; ?>";

                if (!isAuthorized) {
                    alert('Вы не авторизованы. Пожалуйста, войдите в систему.');
                    return false;
                }

                // Проверяем, что все поля заполнены
                var name = document.getElementById('name').value;
                var description = document.getElementById('description').value;
                var type = document.getElementById('type').value;

                if (!name || !description || !type) {
                    alert('Пожалуйста, заполните все поля.');
                    return false;
                }

                // Отправляем данные на сервер с помощью AJAX
                var formData = new FormData(this); // Создаем объект FormData для отправки данных формы

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'submit_ticket.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById('message').textContent = xhr.responseText; // Отображаем ответ сервера
                        document.getElementById('ticket-form').reset(); // Очищаем форму
                    } else {
                        console.error('Произошла ошибка: ' + xhr.status);
                    }
                };
                xhr.onerror = function() {
                    console.error('Ошибка сети');
                };
                xhr.send(formData);
            });
        });
    </script>
	</main>
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
