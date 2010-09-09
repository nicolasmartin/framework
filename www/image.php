<?php
  define('ROOT', dirname(__FILE__).'/../');
	require_once ROOT.'_lib/core/_includes.php';

	// Environnements
	include ROOT.'configs/env.php';

	if (!isset($_GET) || empty($_GET)) {
			throw new Exception("Paramètres d'image manquants");
	}

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();	
	$Bootstrap->setEnv(ENV);
	$Bootstrap->loadConfigs(ROOT.'configs/default/');
  
	$default = array(
			'src'       => false,
			'width'     => 200,
			'height'    => false,
			'mode'      => false,
	);
	extract(array_merge($default, $_GET));

	if (!$height) {
			 $height = $width;
	 }

	if (Config::get('cache.pictures')) {
		sort($_GET);
		$cachename = ROOT.'cache/'.sha1($src.'&'.http_build_query($_GET));
		$Cache = new CacheComponent($cachename, '-1 month');
		$Cache->open();
	}
	
	$Image = new ImageComponent(ROOT.'www/'.$src);
	if ($mode == 'crop') {
			$Image->thumbnail($width, $height);
	} elseif ($mode == 'zoom') {
			$Image->zoom($width, $height);    
	} else {
			$Image->resize($width, $height);
	}
	$Image->show();

	if (Config::get('cache.pictures')) {
	 $Cache->close();
	}
	
	flush();
