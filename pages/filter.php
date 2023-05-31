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
				if(isset($_POST["Brand"]))		//Проверка на получение данных из POST запроса
				{
					$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");   // Подключаемся к серверу
					if($_POST["Brand"] == 'Samsung')
						$sql1 = "SELECT * FROM `Products` WHERE `Brand` REGEXP 'Samsung'";		//Запрос на отображение таблицы где Бренд === Samsung
					elseif($_POST["Brand"] == 'Xiaomi')
						$sql1 = "SELECT * FROM `Products` WHERE `Brand` REGEXP 'Xiaomi'";		
					elseif($_POST["Brand"] == 'iPhone')
						$sql1 = "SELECT * FROM `Products` WHERE `Brand` REGEXP 'iPhone'";
					elseif($_POST["Brand"] == 'Poco')
						$sql1 = "SELECT * FROM `Products` WHERE `Brand` REGEXP 'Poco'";
					elseif($_POST["Brand"] == 'Redmi')
						$sql1 = "SELECT * FROM `Products` WHERE `Brand` REGEXP 'Redmi'";
					else
					{
						echo "Database error: Brand unknown";				// Если данные из бд не получены 
						$sql1 = "SELECT * FROM Products";
					}
					$result = $conn->query($sql1);
					echo "<p><table><tr><th>Бренд</th><th>Название</th><th><a href ='/sortdown'>Стоимость</a></th></tr></p>"; //Создание таблицы
					while($row = $result->fetch())
					{
						echo "<tr>";					
							echo "<td>" . $row["Brand"] . "</td>";
							echo "<td>" . $row["Series"] . "</td>";
							echo "<td>" . $row["Price"] . "</td>";
							echo "<td><form action='update' method='post'>
								<input type='hidden' name='id' value='" . $row["id"] . "' />
								<input type='submit' value='Изменение'>
							</form></td>";
							echo "<td><form action='delete' method='post'>
								<input type='hidden' name='id' value='" . $row["id"] . "' />
								<input type='submit' value='Удаление'>
							</form></td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				else
				{
					echo "Database error: Brand unknown";
				}
			}
			catch (PDOException $e) 
			{
				echo "Database error: " . $e->getMessage();
			}
		?>
		<!--кнопка возвращения на предыдущую страницу-->
		<p><form id="back1" action="<?php echo $_SERVER['HTTP_REFERER'] ?>" method='post'>             
			<input type='submit' value='Назад'>
		</form></p>
	</div>
	</body>
</html>
