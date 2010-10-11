<?php
	define('ROOT', 			realpath(dirname(__FILE__).'/../../').'/');
	define('CONTROLLERS', 	ROOT.'controllers/');
	define('VIEWS', 		ROOT.'views/');
	define('MODELS', 		ROOT.'models/');
	
	require_once ROOT.'_lib/core/_includes.php';
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';

	// Environnements
	define('ENV', 'dev');

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);

	$Bootstrap->loadConfigs(ROOT.'configs/default/');
	
	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
