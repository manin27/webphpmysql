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
		try
		{
			if(isset($_POST["id"]) && isset($_POST["Brand"]) && isset($_POST["Series"]) && isset($_POST["Price"]))		//Проверка на получение данных из POST запроса
			{
				$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");		// Подключаемся к серверу
				$sql = "UPDATE Products SET Brand = :productbrand, Series = :productseries, Price = :productprice WHERE id = :productid"; //Запрос на изменение данных по идентификатору
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(":productid", $_POST["id"]);		//Связываем параметр с конкретным значением
				$stmt->bindValue(":productbrand", $_POST["Brand"]);
				$stmt->bindValue(":productseries", $_POST["Series"]);
				$stmt->bindValue(":productprice", $_POST["Price"]);				  
				$stmt->execute();
				header("Location: users");		//Возвращение на основную страницу
			}	
		}
		catch (PDOException $e)
		{
			echo "Database error: " . $e->getMessage();
		}
	?>
    </body>
</html>
