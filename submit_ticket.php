<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Подключение к базе данных
    $mysqli = new mysqli('localhost', 'andre053_pmauser', 'PASSWORD1478', 'andre053_mfc_site');

    if ($mysqli->connect_error) {
        die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
    }

    // Получение данных из формы
    $date = $_POST['date'];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    // Подготовка и выполнение SQL-запроса
    $stmt = $mysqli->prepare("INSERT INTO tickets (date, name, user, description, type, status) VALUES (?, ?, ?, ?, ?, 'На рассмотрении')");
    $stmt->bind_param('sssss', $date, $name, $username, $description, $type);

    if ($stmt->execute()) {
        echo "Заявка успешно отправлена!";
    } else {
        echo "Ошибка отправки заявки: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "Неверный метод запроса.";
}
?>
