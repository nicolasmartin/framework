<?php
	define('ROOT', 			realpath(dirname(__FILE__).'/../../')."/");
	define('CONTROLLERS', 	ROOT.'controllers/default/');
	define('VIEWS', 		ROOT.'views/default/');
	define('MODELS', 		ROOT.'models/');

	require_once(ROOT.'_lib/vendors/simpletest/autorun.php');
	require_once ROOT.'_lib/core/_includes.php';
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';

	// Environnement
	define('ENV', 'test');

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);

	$Bootstrap->addAutoloadPath(ROOT.'controllers/default/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/default/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'views/default/_helpers/');

	$Bootstrap->loadConfigs(ROOT.'configs/default/');
	
	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
