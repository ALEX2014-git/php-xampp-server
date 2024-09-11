<?php
header('Content-Type: application/json');
include 'db_connect.php';

$query = "SELECT id, status FROM tickets WHERE updated_at > NOW() - INTERVAL 10 SECOND";
$result = $conn->query($query);

$updates = [];
while ($row = $result->fetch_assoc()) {
    $updates[] = [
        'ticket_id' => $row['id'],
        'status' => $row['status']
    ];
}

echo json_encode(['updates' => $updates]);

$conn->close();
?>
