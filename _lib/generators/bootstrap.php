<?php
	header('Content-type: text/html; charset=UTF-8');
	
	define('ROOT', realpath(dirname(__FILE__).'/../../'));
	define('LIB', ROOT.'/_lib');

	require_once LIB.'/core/_includes.php';
	require_once LIB.'/vendors/doctrine/Doctrine.php';

	define('ENV', 'dev');

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setEnv(ENV);

	if (file_exists(ROOT.'/configs')) {
		require_once ROOT.'/configs/set.php';
		$Bootstrap->loadConfigs(ROOT.'/configs/');
	}
	
	if (file_exists(ROOT.'/models')) {
		define('MODELS', ROOT.'/models');	
		
		$Bootstrap->addModelPath(MODELS.'/bases/');
		$Bootstrap->addModelPath(MODELS);
		$Bootstrap->setDoctrine();
	}

