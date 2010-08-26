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
	ini_set('display_errors', 1);
	if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
		define('ENV', 'dev');
	} else if ($_SERVER['SERVER_NAME'] == 'domain.com') {
		define('ENV', 'prod');
		ini_set('display_errors', 0);
	} else {
		throw new Exception('Aucun environnement disponible.');	
	}

	// Bootstrap	
	$Bootstrap = new Bootstrap();
	$Bootstrap->setDefaultController('scripts/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(ROOT.'controllers/doctrine/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/doctrine/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'views/doctrine/_helpers/');
	$Bootstrap->addAutoloadPath(ROOT.'views/_helpers/');
		
	$Bootstrap->loadConfigs(ROOT.'configs/');
	$Bootstrap->loadConfigs(ROOT.'configs/admin/');
	$Bootstrap->loadConfigs(ROOT.'configs/doctrine/');

	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
	
	$Bootstrap->dispatch();
