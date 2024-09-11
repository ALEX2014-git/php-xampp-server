<?php
session_start();
$db = new mysqli('localhost', 'andre053_pmauser', 'PASSWORD1478', 'andre053_mfc_site');
if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $db->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        echo "success"; 
} else {
     echo "401"; 
}
}
$db->close();
?>