<?php
$mysqli = new mysqli('localhost', 'andre053_pmauser', 'PASSWORD1478', 'andre053_mfc_site');
if ($mysqli->connect_error) {
    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $ticket_id = $_POST['ticket_id'];

    if ($action === 'change_status' && isset($_POST['status'])) {
        $status = $_POST['status'];
        $stmt = $mysqli->prepare("UPDATE tickets SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $status, $ticket_id);
        if ($stmt->execute()) {
            echo "Статус заявки обновлен";
        } else {
            echo "Ошибка обновления статуса заявки";
        }
        $stmt->close();
    } elseif ($action === 'delete_ticket') {
        $stmt = $mysqli->prepare("DELETE FROM tickets WHERE id = ?");
        $stmt->bind_param('i', $ticket_id);
        if ($stmt->execute()) {
            echo "Заявка удалена";
        } else {
            echo "Ошибка удаления заявки";
        }
        $stmt->close();
    }
}

$mysqli->close();
?>