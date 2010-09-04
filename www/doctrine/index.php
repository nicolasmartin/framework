<?
	define('ROOT', 			realpath(dirname(__FILE__).'/../../')."/");
	define('CONTROLLERS', 	ROOT.'controllers/doctrine/');
	define('VIEWS', 		ROOT.'views/doctrine/');
	define('MODELS', 		ROOT.'models/');
	
	require_once ROOT.'_lib/core/_includes.php';
	
	// Vendors
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';
	require_once ROOT.'_lib/vendors/image/class.image.php';

	// Environnements
	include ROOT.'configs/env.php';

	// Bootstrap	
	$Bootstrap = new Bootstrap();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(ROOT.'controllers/doctrine/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/doctrine/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/default/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'views/doctrine/_helpers/');
	$Bootstrap->addAutoloadPath(ROOT.'views/default/_helpers/');
		
	$Bootstrap->loadConfigs(ROOT.'configs/default/');
	$Bootstrap->loadConfigs(ROOT.'configs/doctrine/');

	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
	
	$Bootstrap->dispatch();
