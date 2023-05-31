<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../style/main.css">
		<title>WebPHPMySQL</title>
    </head>
    <body>
	<?php
		if(isset($_POST["id"]))		//Проверка на получение данных из POST запроса
		{
			try {
				$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");  	// Подключаемся к серверу
				$sql = "DELETE FROM Products WHERE id = :productid";		//Запрос на удаление строки по идентификатору
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(":productid", $_POST["id"]);		//Связываем параметр с конкретным значением
				$stmt->execute();
				header("Location: users");		//Возвращение на главную страницу
			}
			catch (PDOException $e) {
				echo "Database error: " . $e->getMessage();
			}
		}
	?>
	</body>
</html>
