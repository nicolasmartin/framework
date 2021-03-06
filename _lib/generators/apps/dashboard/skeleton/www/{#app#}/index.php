<?php
	define('ROOT', realpath(dirname(__FILE__).'/../../'));
	define('LIB', 			ROOT.'/_lib');
	define('APP', 			ROOT.'/apps'.dirname($_SERVER['SCRIPT_NAME']));
	define('MODELS',		ROOT.'/models');	
	define('CONTROLLERS',	APP.'/controllers');
	define('VIEWS',			APP.'/views');
		
	require_once LIB.'/core/_includes.php';
	require_once LIB.'/vendors/doctrine/Doctrine.php';
	require_once ROOT.'/configs/env.php';
	require_once ROOT.'/configs/lang.php';
	require_once ROOT.'/configs/set.php';

	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(CONTROLLERS);
	$Bootstrap->addAutoloadPath(CONTROLLERS.'/_components');

	$Bootstrap->addAutoloadPath(VIEWS);
	$Bootstrap->addAutoloadPath(VIEWS.'/_helpers');
	
	$Bootstrap->loadConfigs(ROOT.'/configs');
	$Bootstrap->loadConfigs(APP.'/configs');
		
	$Bootstrap->addModelPath(MODELS.'/bases');
	$Bootstrap->addModelPath(MODELS);
	
	$Bootstrap->setDoctrine();

	$Bootstrap->dispatch();
