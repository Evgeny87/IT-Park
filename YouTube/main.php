<?php
function main ()
	{
		$apikey = "AIzaSyB9X4cOVcKfiMrsvcCxziE0xZbuBz7DhdI"; // Ваш ключ к api youtube v3
		$timeout = 10;
		$video = array();
		$YouTubeApiUrl = 'https://www.googleapis.com/youtube/v3/';

		// Проверка, что запрос отправлен (и он не пустой)
		if (isset($_REQUEST['search']) && isset($_REQUEST['limit'])) {
			$search = strip_tags($_REQUEST['search']); //  Поисковый запрос
			$limit = strip_tags($_REQUEST['limit']); // Количество результатов
			$res_json = youtube_search($YouTubeApiUrl, $apikey, $search, $limit, $timeout);
			$res = fromJson($res_json, true);

			// Формируем массив $Video[]
			foreach ($res['items'] as $res) {
//		       switch ($res['id']['kind']) {
//		          case 'youtube#video':
				if (($res['id']['kind'])=='youtube#video') {
							$videoId=$res['id']['videoId'];
							$res_json_2 = youtube_video($YouTubeApiUrl, $apikey, $videoId, $timeout);
							$res_2 = fromJson($res_json_2, true);
							
							foreach ($res_2['items'] as $res_2) {
								$video[] = videoArr ($res, $res_2);
							}
				}
//				}
			}
			
			// сортировка массива по количеству просмотров (от большего к меньшему)
			arsort ($video);
		}
		return $video;
	}
?>