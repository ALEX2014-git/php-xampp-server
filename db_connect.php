<?php
$servername = "localhost";
$username = "andre053_pmauser";
$password = "PASSWORD1478";
$dbname = "andre053_mfc_site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
