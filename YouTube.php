	<form action="" method="GET">
		<p>Введите запрос: <input name="search" value="<?php if(isset($_REQUEST['search'])) echo $_REQUEST['search']; ?>"></p>
		<p>Введите кол-во видео: <input name="limit" value="<?php if(isset($_REQUEST['limit'])) echo $_REQUEST['limit']; ?>"></p>
		<input type="submit">
	</form>
<?php
// http://www.леха.com/2016/11/youtube-api-v-3-parsing-videorolikov-po-klyuchevym-frazam-na-php/
function youtube_search($apikey, $search, $limit){
	$search =  urlencode($search);
	$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$search&type=video&maxResults=$limit&regionCode=RU&key=$apikey";
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
if (isset($_REQUEST['search'])) {
$search = strip_tags($_REQUEST['search']); //  Поисковый запрос
$limit = strip_tags($_REQUEST['limit']); // Количество результатов
}
$apikey = "AIzaSyB9X4cOVcKfiMrsvcCxziE0xZbuBz7DhdI"; // Ваш ключ к api youtube v3
$res_json = youtube_search($apikey, $search, $limit) ;
$res = json_decode( $res_json, true);
$videos = array();
//		echo '<pre>';
//		echo var_dump($res);
	foreach ($res['items'] as $res) {
		switch ($res['id']['kind']) {
			case 'youtube#video':
				$videos[] = array('videoTitle'=>$res['snippet']['title'],
					'videoURL'=>'https://www.youtube.com/watch?v='.$res['id']['videoId'],
					'videoiframe'=>'https://www.youtube.com/embed/'.$res['id']['videoId'],
					'videodescription'=>$res['snippet']['description'],
					'videoData'=>date('d.m.Y H:i:s', strtotime($res['snippet']['publishedAt'])),
					'channelURL'=>'https://www.youtube.com/watch?v='.$res['snippet']['channelId'],
					'channelTitle'=>$res['snippet']['channelTitle']);
?>
<p>
<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$res['id']['videoId']?>" frameborder="0" allowfullscreen></iframe>
</p>
		<p>Ссылка на видео: 
		<a href="https://www.youtube.com/watch?v=<?=$res['id']['videoId']?>">
			<?=$res['snippet']['title']?>
		</a></p>
		<p>Описание:
		<?=$res['snippet']['description']?></p>
		<p>Дата и время публикации видео:
		<?= date('d.m.Y H:i:s', strtotime($res['snippet']['publishedAt']));?></p>
		<p>Ссылка на канал: 
		<a href="https://www.youtube.com/watch?v=<?=$res['snippet']['channelId']?>">
			<?=$res['snippet']['channelTitle']?>
		</a></p>
		</br>
<?php
	}
}
//var_dump ($videos);
?>
