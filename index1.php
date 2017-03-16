<?php
	// Функция создания и добавление текста в файл
    file_put_contents('1fail.txt', 'Hello, world!');

	// Вывод на экран данные из сфайла
    echo file_get_contents('1fail.txt');
?>
	