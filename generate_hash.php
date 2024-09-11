<?php
$hashed_password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем пароль из поля ввода
    $password = $_POST['password'];

    // Хэшируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генератор хэшей паролей</title>
    <script>
        function copyToClipboard() {
            var hashedPassword = document.getElementById("hashed_password");
            hashedPassword.select();
            document.execCommand("copy");
            alert("Хэш скопирован в буфер обмена.");
        }
    </script>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="password">Введите пароль:</label>
        <input type="password" id="password" name="password">
        <button type="submit">Сгенерировать хэш</button>
    </form>

    <?php if ($hashed_password): ?>
        <div>
            <label for="hashed_password">Сгенерированный хэш пароля:</label>
            <input type="text" id="hashed_password" value="<?php echo $hashed_password; ?>" readonly>
            <button onclick="copyToClipboard()">Копировать</button>
        </div>
    <?php endif; ?>
</body>
</html>