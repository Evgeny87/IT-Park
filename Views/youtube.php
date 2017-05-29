<!-- блок аккордеон -->
<div class="accordion">
<?php
// Проверка, что запрос отправлен (и он не пустой)
if (isset($_REQUEST['search']) && isset($_REQUEST['limit'])):	
    // Вывод видео
$i = 1;
    foreach ($video as $videoParams):
?>

    <section class="accordion_item">
        <h3 class="title_block"><?=$i.". ".$videoParams['videoTitle']?></h3>
        <div class="info">
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
        </div>
    </section>
<?php
	$i++;
	endforeach;
endif;
?>
</div>
<!-- конец блока аккордеон -->