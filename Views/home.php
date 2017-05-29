<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.png" />
    <?php foreach ($files["css"] as $file):?>
		<link rel="stylesheet" href="public/css/<?=$file?>.css" />
    <?php endforeach;?>
    <?php foreach ($files["js"] as $file):?>
    	<script src="public/js/<?=$file?>.js"></script>
    <?php endforeach;?>
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<form action="" method="GET">
	<p>Введите запрос: <input  type="text" name="search"  placeholder="Введите запрос" value="<?php if(isset($_REQUEST['search'])) echo $_REQUEST['search']; ?>"></p>
	<p>Введите кол-во видео: <input  type="number" name="limit"  min="1" max="20" step="1" value="<?php if(isset($_REQUEST['limit'])) echo $_REQUEST['limit']; else echo "20" ?>"></p>
	<input type="submit" value="Поиск" name="submit">
	<?php
	// Проверка, что запрос отправлен (и он не пустой)
	if (isset($_REQUEST['search']) && isset($_REQUEST['limit']) && !isset($_REQUEST['sortViewCount'])):
	?>
	<input type="submit" value="Сортировка по просмотрам" name="sortViewCount">
	<?php
	endif;
	?>
</form>
<?php require_once "youtube.php";?>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
	
</body>
</html>

