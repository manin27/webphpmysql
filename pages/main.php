<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../style/main.css">
		<title>WebPHPMySQL</title>
    </head>
    <body class ="is-grid">
	<div id="menu">
		<?php
			if (isset($_POST["brandname"]) && isset($_POST["seriesname"]) && isset($_POST["productprice"])) {		//Получение данных из POST запроса
				try { 
					$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");   // Подключаемся к серверу
					$sql = "INSERT INTO Products (Brand, Series, Price) VALUES (:brandname, :seriesname, :productprice)";		//Запрос на добавление продукта в таблицу
					$stmt = $conn->prepare($sql);           // Определяем prepared statement
					$rowsNumber = $stmt->execute(array(":brandname" => $_POST["brandname"], ":seriesname" => $_POST["seriesname"], ":productprice" => $_POST["productprice"])); 	// Через массив передаем значения параметрам по имени
					if($rowsNumber > 0 ){				// Если добавлена как минимум одна строка
						echo "Data successfully added: name=" . $_POST["brandname"] ." " . $_POST["seriesname"] ." age= " . $_POST["productprice"]; 
						header("location:users");
					}
				}
				catch (PDOException $e) {
					echo "Database error: " . $e->getMessage();
				}
			}
		?>
		<h1>База данных телефонов</h1>
		<h3>Добавить новый телефон</h3>
		<!--Создание формы добавления продукта-->
		<form id="add" method="post">
			<p>Название бренда:
			<select name="brandname">
			<option value="Samsung">Samsung</option>
			<option value="iPhone">iPhone</option>
			<option value="Xiaomi">Xiaomi</option>
			<option value="Redmi">Redmi</option>
			<option value="Poco">Poco</option>
			</select>
			<p>Название серии:
			<input type="text" name="seriesname" /></p>
			<p>Стоимость продукта:
			<input type="float" name="productprice" /></p> 
			<input type="submit" value="Добавить" >
		</form>
		<?php
			try {
				$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");   // Подключаемся к серверу
				$sql1 = "SELECT * FROM Products";
				$result = $conn->query($sql1);
				echo "<p><table><tr><th>Бренд</th><th>Название</th><th><a href=sortdown>Стоимость</a></th></tr></p>";		//Создание таблицы продуктов
				while($row = $result->fetch()){
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
