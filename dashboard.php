<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
	
	        $(document).ready(function(){	
	            $("#logout-button").click(function(e){
			   e.preventDefault();
                $.ajax({
                    url: "logout.php",
                    type: "POST",
                    success: function(response){
					if(response == "success"){
						var currentPage = window.location.href;
			if (currentPage.includes('/service') || currentPage.includes('/form')) {
						location.reload();
						}   
                        $("#dashboard-container").empty();
                        $("#login-container").show();
						}
                    }
                });
            });
			});
	
        <?php
        $userRole = $_SESSION['role'];
        echo "var userRole = '$userRole';";
        echo "if (userRole === 'default') {";
        echo "    document.getElementById('user-role').innerText = 'Обычный';";
        echo "} else if (userRole === 'admin') {";
        echo "    document.getElementById('user-role').innerText = 'Административный';";
        echo "}";
        ?>
    </script>
</head>
<body>
    <h1>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Ваш уровень доступа: <span id="user-role"><?php echo $_SESSION['role']; ?></span></p>
    <button id="logout-button">Выйти</button>
</body>
</html>