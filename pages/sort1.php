<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../style/main.css">
		<title>WebPHPMySQL</title>
    </head>
    <body>
	<div id="menu">
		<h1>База данных телефонов</h1>
		<?php
			try {
				$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");   // Подключаемся к серверу
				$sql1 = "SELECT * FROM `Products` ORDER BY `Products`.`Price` DESC";		//Запрос для сортировки
				$result = $conn->query($sql1);
				echo "<p><table><tr><th>Бренд</th><th>Название</th><th><a href=sortup>Стоимость</a></th></tr></p>";		//Создание таблицы
				while($row = $result->fetch()){
					echo "<tr>";
						echo "<td>" . $row["Brand"] . "</td>";
						echo "<td>" . $row["Series"] . "</td>";
						echo "<td>" . $row["Price"] . "</td>";
						echo "<td><form action='filter' method='post'>
							<input type='hidden' name='Brand' value='" . $row["Brand"] . "' />
							<input type='submit' value='Фильтр'>
						</form></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			catch (PDOException $e) {
				echo "Database error: " . $e->getMessage();
			}
		?>
	</div>
    </body>
</html>
