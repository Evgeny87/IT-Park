<?php

namespace API\YouTube;

use Helpers\JSON;

class Core
{
//	protected $apiUrl;
	
    protected function query(array $params)
	{
//		$paramsDefault = ['format' => 'json'];
//		$paramsExtended = array_merge($params, $paramsDefault);
//		$paramsRow = http_build_query($paramsExtended);
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERAGENT,             "Mozilla/5.0 (Windows NT 5.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1");
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,        FALSE);
		curl_setopt($curl, CURLOPT_HEADER,                false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION,        true); //если выпадает ошибка на эту строку - попробуйте закомментировать её
		curl_setopt($curl, CURLOPT_URL,                   $url);
		curl_setopt($curl, CURLOPT_REFERER,               $url);
//	curl_setopt($ch, CURLOPT_RETURNTRANSFER,        TRUE);
// или
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,        1);
		$response = curl_exec($curl);
		curl_close($curl);
		return JSON::fromJson($response);
	}
}
