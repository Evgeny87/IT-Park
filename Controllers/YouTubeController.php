<?php

namespace Controllers;

use View;
use API\YouTube;

# require_once "./View.php";
# require_once "./API/YouTube.php";

class YouTubeController {
	
	public function index()
	{
		$files = array(
			"css" => array(
				"main",
				"style",
				"media",
				"bootstrap-grid-3.3.1.min"
			),
			"js" => array(
				"jquery-1.11.1.min",
				"jquery.mousewheel.min",
				"common"
			));
		$api = new YouTube();
	    return View::render('home',array("video" => $api->getVideo(),"files" => $files));
	}


	public function error404()
	{
	    return View::render('error/404');
	}
}
?>
