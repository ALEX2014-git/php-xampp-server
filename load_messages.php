<?php
session_start();
header('Content-Type: application/json');
require 'db_connect.php';

$response = array('messages' => array());

$sql = "SELECT * FROM messages ORDER BY timestamp ASC"; // Сортируем по возрастанию времени
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['timestamp'] = date('d.m.Y H:i', strtotime($row['timestamp'])); // Форматируем метки времени
        $response['messages'][] = $row;
    }
}

echo json_encode($response);
?>
