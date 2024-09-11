<?php

$conn = new mysqli('localhost', 'andre053_pmauser', 'PASSWORD1478', 'andre053_mfc_site');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM knowledge_base";
$result = $conn->query($sql);

$modules = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $modules[] = $row;
    }
}

echo json_encode($modules);

$conn->close();
?>
