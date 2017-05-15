<form action="" method="GET">
	<p>Введите запрос: <input  type="text" name="search"  placeholder="Введите запрос" value="<?php if(isset($_REQUEST['search'])) echo $_REQUEST['search']; ?>"></p>
	<p>Введите кол-во видео: <input  type="number" name="limit"  min="1" max="20" step="1" value="<?php if(isset($_REQUEST['limit'])) echo $_REQUEST['limit']; else echo "20" ?>"></p>
	<input type="submit">
</form>

<?php
// Проверка, что запрос отправлен (и он не пустой)
if (isset($_REQUEST['search']) && isset($_REQUEST['limit'])):	
    // Вывод видео
    foreach ($video as $videoParams):
?>
    <p>
		<iframe width="560" height="315" src="<?= $videoParams['videoiframe'] ?>" frameborder="0" allowfullscreen></iframe>
    </p>

    <p>Ссылка на видео:
		<a href="<?= $videoParams['videoURL'] ?>">
			<?= $videoParams['videoTitle'] ?>
		</a>
	</p>
    <p>Описание:
        <?= $videoParams['videodescription'] ?>
	</p>
    <p>Дата и время публикации видео:
        <?= $videoParams['videoData']; ?>
	</p>
    <p>Ссылка на канал:
        <a href="<?= $videoParams['channelURL'] ?>">
            <?= $videoParams['channelTitle'] ?>
        </a>
	</p>
    <p>Кол-во просмотров:
        <?= $videoParams['viewCount']; ?>
	</p>
    </br>
<?php
	endforeach;
endif;
?>
