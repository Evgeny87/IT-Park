<?php
// использованные сайты
// http://www.леха.com/2016/11/youtube-api-v-3-parsing-videorolikov-po-klyuchevym-frazam-na-php/
// http://www.meweb.ru/articles.php?article_id=73
// https://github.com/youtube/api-samples/blob/master/php/search.php

require 'main.php';
require 'logics.php';

//	if (isset($_REQUEST['search']) && isset($_REQUEST['limit'])) {
		$video = main ();
//	}

require 'view.php';
?>
