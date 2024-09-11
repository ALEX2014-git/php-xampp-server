<?php
session_start();
header('Content-Type: application/json');
require 'db_connect.php';

$response = array('success' => false);

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $message = $_POST['message'];
    $timestamp = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO messages (username, message, timestamp) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $username, $message, $timestamp);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = 'Не удалось отправить сообщение.';
    }
} else {
    $response['error'] = 'Вы не авторизованы или чат закрыт для отправки сообщений.';
}

echo json_encode($response);
?>
