<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корпоративный портал технической поддержки</title>
    <link rel="stylesheet" href="main.css">
	<style>
	   /* Новый стиль для увеличения текста */
        #welcome p, #services p, #news ul {
            font-size: 24px; /* Увеличенный размер шрифта */
        }
        #welcome h2, #services h2, #news h2 {
            font-size: 26px; /* Увеличенный размер заголовков */
        }
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
    
    <main>
        <section id="welcome">
            <h2>Добро пожаловать</h2>
            <p>Добро пожаловать на корпоративный портал технической поддержки МФЦ. Здесь вы можете получить помощь по всем вопросам, связанным с работой наших сервисов и услуг.</p>
        </section>

        <section id="services">
            <h2>Наши услуги</h2>
            <p>Многофункциональные центры (МФЦ) предоставляют широкий спектр услуг, охватывающий различные аспекты взаимодействия граждан с государственными и муниципальными органами. Они функционируют как универсальные точки доступа к государственным и муниципальным услугам, обеспечивая высокий уровень сервиса и удобство для пользователей.

В МФЦ граждане могут получить помощь и консультации по различным аспектам административных процедур, начиная с подачи документов и оформления разрешений, и заканчивая решением сложных правовых и организационных вопросов. Сотрудники МФЦ предлагают квалифицированную поддержку по оформлению паспортов, водительских удостоверений и других важных документов, что упрощает процедуру взаимодействия с государственными органами.

Основной задачей МФЦ является создание комфортных условий для обращения граждан, обеспечивая доступность и прозрачность административных процедур. Это достигается через использование современных технологий, автоматизацию процессов и активное взаимодействие с общественностью. Благодаря этому МФЦ становятся не только местом решения организационных вопросов, но и центром, способствующим развитию эффективных государственных услуг и повышению уровня удовлетворенности граждан.</p>
        </section>

        <section id="news">
            <h2>Последние новости и обновления</h2>
            <ul>
                <li>Новая версия программного обеспечения доступна для загрузки.</li>
                <li>Обновление политики информационной безопасности МФЦ.</li>
                <li>Плановое обслуживание серверов с 25 по 27 июня.</li>
            </ul>
        </section>

<!--         <section id="help">
            <h2>Получите помощь прямо сейчас</h2>
            <form action="submit.php" method="post">
                <label for="name">Ваше имя:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Ваш email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Ваше сообщение:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                <input type="submit" value="Отправить">
            </form>
        </section> -->
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