<?
	define('ROOT', 			realpath(dirname(__FILE__).'/../')."/");
	define('CONTROLLERS', 	ROOT.'controllers/default/');
	define('VIEWS', 		ROOT.'views/default/');
	define('MODELS', 		ROOT.'models/');
		
	require_once ROOT.'_lib/core/_includes.php';
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';
	require_once ROOT.'_lib/vendors/rss/class.rss.php';

	// Environnements
	include ROOT.'configs/env.php';

	// Langues
	if (isset($_GET['LANG']) && $_GET['LANG']) {
		define('LANG', $_GET['LANG']);
	} else {
		define('LANG', i18n::detectLanguage(array('en', 'fr'), 'en'));
	}
	i18n::setCulture(LANG);
	i18n::addDefinitionPath(ROOT.'configs/default/i18n/');
	i18n::loadDefinitions();

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

	$Bootstrap->dispatch();
