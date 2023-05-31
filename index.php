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
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', trim($uri, '/'));		//Создание сегментов
		if($segments[0] === 'admin')		//Страницы для администраторов
		{
			if($segments[1] === 'users')
				$file = 'main.php';
			elseif($segments[1] === 'update')
				$file = 'update.php';
			elseif($segments[1] === 'update1')
				$file = 'update1.php';
			elseif($segments[1] === 'delete')
				$file = 'delete.php';
			elseif($segments[1] === 'sortdown')
				$file = 'sort3.php';
			elseif($segments[1] === 'sortup')
				$file = 'sort4.php';
			elseif($segments[1] === 'filter')
				$file = 'filter.php';
			else
				$file = 'error404.php';
		}
		else
		{
			if($uri ==='/')		//Страницы для пользователей
				$file = 'table.php';
			elseif($segments[0] === 'sortdown')
				$file = 'sort1.php';
			elseif($segments[0] === 'sortup')
				$file = 'sort2.php';
			elseif($segments[0] === 'filter')
				$file = 'filter2.php';
			else 
				$file = 'error404.php';
		}
		
		require 'pages/' . $file;
	?>
	</body>
</html>