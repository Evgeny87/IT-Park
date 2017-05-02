	<form action="" method="GET">
		<p>Введите запрос: <input name="search" value="<?php if(isset($_REQUEST['search'])) echo $_REQUEST['search']; ?>"></p>
		<p>Введите кол-во видео: <input name="limit" value="<?php if(isset($_REQUEST['limit'])) echo $_REQUEST['limit']; ?>"></p>
		<input type="submit">
	</form>
<?php
// http://www.леха.com/2016/11/youtube-api-v-3-parsing-videorolikov-po-klyuchevym-frazam-na-php/
function youtube_search($apikey, $search, $limit){
	$search =  urlencode($search);
	$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&order=viewCount&q=$search&type=video&maxResults=$limit&regionCode=RU&key=$apikey";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT,             "Mozilla/5.0 (Windows NT 5.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,        FALSE);
	curl_setopt($ch, CURLOPT_HEADER,                false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,        true); //если выпадает ошибка на эту строку - попробуйте закомментировать её
	curl_setopt($ch, CURLOPT_URL,                   $url);
	curl_setopt($ch, CURLOPT_REFERER,               $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,        TRUE);
	$out = curl_exec($ch);
	curl_close($ch);
	return $out;
}

$apikey = "AIzaSyB9X4cOVcKfiMrsvcCxziE0xZbuBz7DhdI"; // Ваш ключ к api youtube v3

// Проверка, что запрос отправлен (и он не пустой)
if (isset($_REQUEST['search']) && isset($_REQUEST['limit'])) {
    $search = strip_tags($_REQUEST['search']); //  Поисковый запрос
    $limit = strip_tags($_REQUEST['limit']); // Количество результатов
    $res_json = youtube_search($apikey, $search, $limit);
    $res = json_decode($res_json, true);

    $video = array();

    // Формируем массив $Video[]
    foreach ($res['items'] as $res) {
        switch ($res['id']['kind']) {
            case 'youtube#video':
                $video[] = array('videoTitle' => $res['snippet']['title'],
                    'videoURL' => 'https://www.youtube.com/watch?v=' . $res['id']['videoId'],
                    'videoiframe' => 'https://www.youtube.com/embed/' . $res['id']['videoId'],
                    'videodescription' => $res['snippet']['description'],
                    'videoData' => date('d.m.Y H:i:s', strtotime($res['snippet']['publishedAt'])),
                    'channelURL' => 'https://www.youtube.com/watch?v=' . $res['snippet']['channelId'],
                    'channelTitle' => $res['snippet']['channelTitle']);
        }
    }

    // Вывод видео
    foreach ($video as $videoParams) {
?>
    <p>
    <iframe width="560" height="315" src="<?= $videoParams['videoiframe'] ?>" frameborder="0" allowfullscreen></iframe>
    </p>

    <p>Ссылка на видео:
		<a href="<?= $videoParams['videoURL'] ?>">
			<?= $videoParams['videoTitle'] ?>
    </a></p>
    <p>Описание:
        <?= $videoParams['videodescription'] ?></p>
    <p>Дата и время публикации видео:
        <?= $videoParams['videoData']; ?></p>
    <p>Ссылка на канал:
        <a href="<?= $videoParams['channelURL'] ?>">
            <?= $videoParams['channelTitle'] ?>
        </a></p>
    </br>
<?php
    }
}
?>
