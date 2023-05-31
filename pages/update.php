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
			try 
			{
				if(isset($_POST["id"]))		//Проверка на получение данных из POST запроса
				{
					$conn = new PDO("mysql:host=localhost;dbname=WEBPHP", "root", "");		// Подключаемся к серверу
					$sql = "SELECT * FROM Products WHERE id = :productid";		//Запрос на изменение данных по идентификатору
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(":productid", $_POST["id"]);		//Связываем параметр с конкретным значением
					$stmt->execute();
					if($stmt->rowCount() > 0)
					{	
						foreach($stmt as $row) 
						{
							$productid = $_POST["id"];
							$productbrand = $row["Brand"];
							$productseries = $row["Series"];
							$productprice = $row["Price"];
						}
						echo "<h3>Изменение данных продукта</h3>
							<form id='update' action='update1' method='post'>		
								<input type='hidden' name='id' value='$productid' />
								<p>Brand:
								<input type='text' name='Brand' value='$productbrand' /></p>
								<p>Series:
								<input type='text' name='Series' value='$productseries' /></p>
								<p>Price:
								<input type='float' name='Price' value='$productprice' /></p>
								<input type='submit' value='Сохранить' />
							</form>";			//Создание формы изменеия данных
					}
					else 
					{
						echo "Product unknown";
					}
				}	
				else
				{
					echo "Error date";
				}
			if ($_SERVER['HTTP_REFERER'] === 'http://webphpmysql:8080/admin/filter')		//Проверка Ссылки
			{
				echo "<p><form id='back1' action='users' method='post'>                    
					<input type='submit' value='Назад'>
				</form></p>";	//Кнопка возвращения на предыдущую страницу
			}
			else
			{
				echo "<p><form id='back1' action=". $_SERVER['HTTP_REFERER'] ." method='post'>                    
					<input type='submit' value='Назад'>
				</form></p>";
			}
			}
			catch (PDOException $e) 
			{
				echo "Database error: " . $e->getMessage();
			}
		?>
	</div>
	</body>
</html>
