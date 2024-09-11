<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>База Знаний</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                url: 'fetch_data.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let content = '';
                    if(data.length > 0) {
                        data.forEach(function(module) {
                            content += `
                                <div class="module">
                                    <div class="module-header">
                                        <h2>${module.title}</h2>
                                    </div>
                                    <div class="module-content">
                                        <p>${module.description}</p>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        content = '<p>No modules available</p>';
                    }
                    $('#knowledge-base').html(content);
                    

                    $('.module-header').click(function() {
                        $(this).next('.module-content').slideToggle();
                    });
                },
error: function(xhr, status, error) {
    console.log('XHR status:', xhr.status);
    console.log('XHR response text:', xhr.responseText);
    console.log('Error:', error);
    $('#knowledge-base').html('<p>Failed to load modules. Please try again later. Error: ' + error + '</p>');
}
            });
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .info_container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .module {
            background-color: #fff;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .module-header {
            background-color: #f7f7f7;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }
        .module-content {
            display: none;
            padding: 10px;
			font-size: 1.5em;
        }
        h2 {
            margin: 0;
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
	
    <div class="info_container">
        <h1>База Знаний</h1>
        <div id="knowledge-base">

            <div class="module">
                <div class="module-header">
                    <h2>Module 1</h2>
                </div>
                <div class="module-content">
                    <p></p>
                </div>
            </div>
            <div class="module">
                <div class="module-header">
                    <h2>Module 2</h2>
                </div>
                <div class="module-content">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
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