<?
	define('ROOT', 			realpath(dirname(__FILE__).'/../../')."/");
	define('CONTROLLERS', 	ROOT.'controllers/mobile/');
	define('VIEWS', 		ROOT.'views/mobile/');
	define('MODELS', 		ROOT.'models/');
	
	require_once ROOT.'_lib/core/_includes.php';
	
	// Vendors
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';
	require_once ROOT.'_lib/vendors/image/class.image.php';
	require_once ROOT.'_lib/vendors/mailer/class.mailer.php';

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

	// Langues
	if (isset($_GET['LANG']) && $_GET['LANG']) {
		define('LANG', $_GET['LANG']);
	} else {
		define('LANG', i18n::detectLanguage(array('en', 'fr'), 'en'));
	}

	i18n::setCulture(LANG);
	i18n::addDefinitionPath(ROOT.'configs/i18n/');
	i18n::loadDefinitions();
	
	// Bootstrap	
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultController('default/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(ROOT.'controllers/mobile/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/mobile/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'views/mobile/_helpers/');
	$Bootstrap->addAutoloadPath(ROOT.'views/_helpers/');

	$Bootstrap->loadConfigs(ROOT.'configs/');
	$Bootstrap->loadConfigs(ROOT.'configs/mobile/');

	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
	
	$Bootstrap->dispatch();
