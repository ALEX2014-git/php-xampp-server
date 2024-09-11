
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корпоративный портал технической поддержки</title>
    <link rel="stylesheet" href="header.css">
	<style>
	    .no-visited-color {
            font-size: 26px; /* Размер шрифта */
        }
        .no-visited-color a:link {
            color: blue; /* Цвет ссылки */
            text-decoration: none; /* Убрать подчеркивание, если нужно */
        }
        .no-visited-color a:visited {
            color: blue; /* Цвет ссылки после посещения */
            text-decoration: none; /* Убрать подчеркивание, если нужно */
        }
        .no-visited-color a:hover {
            color: blue; /* Цвет ссылки при наведении */
            text-decoration: underline; /* Добавить подчеркивание при наведении */
        }
        .no-visited-color a:active {
            color: red; /* Цвет активной ссылки */
            text-decoration: underline; /* Добавить подчеркивание для активной ссылки */
        }
        .container {
            text-align: right; 
        }
        
        .container input[type="text"],
        .container input[type="password"] {
            width: 200px; 
            font-size: 14px; 
            padding: 10px; 
        }

        .container button {
            font-size: 14px; 
            padding: 10px 20px; 
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){   

    $.ajax({
        url: "check_session.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            if(data.username) {
                $("#login-container").hide();
				$("#dashboard-container").load("dashboard.php");
            } else {
                $("#login-container").show();
            }
        },
        error: function(xhr, status, error) {
            console.error("Ошибка при проверке сессии: " + error);
        }
    });
});

        $(document).ready(function(){	
            $("#login-form").submit(function(e){
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "login.php",
                    type: "POST",
                    data: formData,
					success: function(response){
						if(response == "success"){
						var currentPage = window.location.href;
	if (currentPage.includes('/service') || currentPage.includes('/form')) {
						location.reload();
						}   
							$("#login-container").hide();
							$("#dashboard-container").load("dashboard.php");
						} else if (response == "404") {
							$("#error-message").html("Пользователь не найден");
						} else if (response == "401") {
							$("#error-message").html("Неверное имя пользователя или пароль");
						}
					}
                });
            });
        });	
    </script>
</head>
<body>
    <header>
        <h1>Корпоративный портал технической поддержки</h1>
          <nav class="no-visited-color">
            <ul>
                <li><a href="main.php">Главная</a></li>
                <li><a href="service.php">Служба учёта</a></li>			
                <li><a href="infobase.php">База знаний</a></li>
                <li><a href="form.php">Отправить заявку</a></li>
                <li><a href="aboutus.php">О нас</a></li>
            </ul>
        </nav>
        <div class="container" id="login-container">
            <form id="login-form" method="post" action="login.php">
                <input type="text" name="username" placeholder="Логин" required><br>
                <input type="password" name="password" placeholder="Пароль" required><br>
                <button type="submit">Войти</button>
            </form>
            <div id="error-message"></div>
        </div>
        <div class= "container" id="dashboard-container"></div>
    </header>
</body>
</html>