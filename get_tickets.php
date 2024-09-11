<?php
session_start();
$mysqli = new mysqli('localhost', 'andre053_pmauser', 'PASSWORD1478', 'andre053_mfc_site');
if ($mysqli->connect_error) {
    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
}

if (isset($_SESSION['role'])) {
    $power = $_SESSION['role'];
} else {
    $power = null;
}
$query = "SELECT * FROM tickets ORDER BY id DESC";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo '<style>
        .ticket-description {
            white-space: pre-wrap; /* Сохраняет переносы строк */
            word-wrap: break-word; /* Переносит длинные слова */
            overflow-wrap: break-word; /* Обеспечивает перенос длинных слов */
            max-width: 800px; /* Ограничивает максимальную ширину описания */
            word-break: break-word; /* Разрывает строки после определенного количества символов */
        }
		    .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-menu.show {
            display: block;
        }
        .dropdown-item {
            padding: 8px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-item:hover {
            background-color: #f1f1f1;
        }
    </style>';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="ticket" data-id="' . $row['id'] . '">';
        echo '<div class="ticket-header">';
        echo '<div>';
        echo '<div class="ticket-date" div style="text-align: left;">Дата: ' . $row['date'] . '</div><br>';
        echo '<div class="ticket-name" div style="text-align: left;">Наименование: ' . $row['name'] . '</div>';
		echo '<div class="ticket-description" div style="text-align: left;">Описание: ' . $row['description'] . '</div>';
        echo '</div>';
        echo '<div>';
        echo '<span class="ticket-status">Статус: ' . $row['status'] . '</span><br>';
        echo '<span class="ticket-type">Тип заявки: ' . $row['type'] . '</span><br>';
		echo '<span class="ticket-user">Пользователь: ' . $row['user'] . '</span>';
        echo '</div>';
        echo '</div>';
		if ($power === 'admin') {
		echo '<div class="ticket-actions">';
		echo '<div class="dropdown">';
		echo '<button class="dropdown-toggle">Выберите статус</button>';
		echo '<div class="dropdown-menu">';
		echo '<a class="dropdown-item" href="#">На рассмотрении</a>';
		echo '<a class="dropdown-item" href="#">Отклонено</a>';
		echo '<a class="dropdown-item" href="#">В процессе</a>';
		echo '<a class="dropdown-item" href="#">Выполнено</a>';
		echo '</div>';
		echo '</div>';
		echo '<button class="btn delete-ticket" data-id="' . $row['id'] . '">Удалить заявку</button>';
		echo '</div>';
		}
		echo '</div>';
    }
} else {
    echo "Нет доступных заявок.";
}
$mysqli->close();
?>
<script>


</script>


