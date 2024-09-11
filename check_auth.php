<?php
session_start();
header('Content-Type: application/json');

$response = array('authenticated' => false);

if (isset($_SESSION['username'])) {
    $response['authenticated'] = true;
    $response['username'] = $_SESSION['username'];
    $response['status'] = $_SESSION['role'];
}

echo json_encode($response);
?>
