<?php

namespace API;

use Helpers\JSON;

class YouTube{




	public function getVideo(){
			$apikey = "AIzaSyB9X4cOVcKfiMrsvcCxziE0xZbuBz7DhdI"; // Ваш ключ к api youtube v3
			$timeout = 10;
			$video = array();
			$YouTubeApiUrl = 'https://www.googleapis.com/youtube/v3/';

			// Проверка, что запрос отправлен (и он не пустой)
			if (isset($_REQUEST['search']) && isset($_REQUEST['limit'])) {
				$search = strip_tags($_REQUEST['search']); //  Поисковый запрос
				$limit = strip_tags($_REQUEST['limit']); // Количество результатов
				$res_json = $this->youtube_search($YouTubeApiUrl, $apikey, $search, $limit, $timeout);
				$res = JSON::fromJson($res_json, true);

				// Формируем массив $Video[]
				foreach ($res['items'] as $res) {
	//		       switch ($res['id']['kind']) {
	//		          case 'youtube#video':
					if (($res['id']['kind'])=='youtube#video') {
								$videoId=$res['id']['videoId'];
								$res_json_2 = $this->youtube_video($YouTubeApiUrl, $apikey, $videoId, $timeout);
								$res_2 =JSON::fromJson($res_json_2, true);
								
								foreach ($res_2['items'] as $res_2) 
									$video[] = $this->videoArr ($res, $res_2);
								
					}
	//				}
				}
				if (isset($_REQUEST['sortViewCount'])) 
					// сортировка массива по количеству просмотров (от большего к меньшему)
					$video=$this->sortViewCount($video);
				
			}
			return $video;
		}


		public function youtube_search($YouTubeApiUrl, $apikey, $search, $limit, $timeout){
		$url = $YouTubeApiUrl . "search?part=snippet&q=$search&type=video&maxResults=$limit&regionCode=RU&key=$apikey";
		$api = $this->get_ydata($url, $timeout);
		return $api;
		}

	public function youtube_video($YouTubeApiUrl, $apikey, $videoID, $timeout){
		$url = $YouTubeApiUrl . "videos?id=".$videoID."&&part=snippet%2Cstatistics%2CcontentDetails&key=".$apikey;
		$api = $this->get_ydata($url, $timeout);
		return $api;
	}
		
	// соединение и парсинг
	public function get_ydata($url, $timeout = 5) {	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT,             "Mozilla/5.0 (Windows NT 5.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,        FALSE);
		curl_setopt($ch, CURLOPT_HEADER,                false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,        true); //если выпадает ошибка на эту строку - попробуйте закомментировать её
		curl_setopt($ch, CURLOPT_URL,                   $url);
		curl_setopt($ch, CURLOPT_REFERER,               $url);
	//	curl_setopt($ch, CURLOPT_RETURNTRANSFER,        TRUE);
	// или
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,        1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,		$timeout);
		$out = curl_exec($ch);
		curl_close($ch);
		return $out;
	}
/*
	// преобразование продолжительности ролика в секунды
	public function ctime($ytime) {
	    $start = new DateTime("@0");
	    $start->add(new DateInterval($ytime));
	    $stime = $start->format("H:i:s");
	    $sc = explode(":", $stime);
	    return $sc[0]*3600+$sc[1]*60+$sc[2];
	}
*/
	// Задаем параметры, которые нам нужны из API YouTuba - к которым в будущем будем обращаться
	public function videoArr ($res, $res_2) {
		$video = array(
			'viewCount' => $res_2['statistics']['viewCount'], // количество просмотров
								
			'published' => date('d.m.Y H:i:s', strtotime($res_2['snippet']['publishedAt'])), // дата публикации
			'title' => $res_2['snippet']['title'], // заголовок
			'description' => $res_2['snippet']['description'], // описание
			'thumb' => $res_2['snippet']['thumbnails'], // превью
			'author' => $res_2['snippet']['channelTitle'], // автор видео
			'authorURL' =>'https://www.youtube.com/channel/' . $res_2['snippet']['channelId'],
	//		'tags' => $res_2['snippet']['tags'],
	//		'duration' => $this->ctime($res_2['contentDetails']['duration'])-1, // продолжительность (переводим в секунды)
	//		'likes' => $res_2['statistics']['likeCount'], // понравилось
	//		'dislikes' => $res_2['statistics']['dislikeCount'], // не понравилось	

			'videoTitle' => $res['snippet']['title'],
			'videoURL' => 'https://www.youtube.com/watch?v=' . $res['id']['videoId'],
			'videoiframe' => 'https://www.youtube.com/embed/' . $res['id']['videoId'],
			'videodescription' => $res['snippet']['description'],
			'videoData' => date('d.m.Y H:i:s', strtotime($res['snippet']['publishedAt'])),
			'channelURL' => 'https://www.youtube.com/watch?v=' . $res['snippet']['channelId'],
			'channelTitle' => $res['snippet']['channelTitle'],
			'thumbs' => $res['snippet']['thumbnails'],
		);
		return $video;
	}


	//Сортировка массива по количеству просмотров (от большего к меньшему)
	public function sortViewCount($video)
	{
		arsort ($video);
		return $video;
	}
}
 ?>
