<?
	define('ROOT', 	realpath(dirname(__FILE__).'/../')."/");
	
	require_once ROOT.'_lib/core/_includes.php';
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';
	require_once ROOT.'_lib/vendors/image/class.image.php';
	require_once ROOT.'_lib/vendors/mailer/class.mailer.php';
	require_once ROOT.'_lib/vendors/rss/class.rss.php';
	
	define('CONTROLLERS', 	ROOT.'controllers/');
	define('VIEWS', 		ROOT.'views/');
	define('MODELS', 		ROOT.'models/');

	// Environnements
	include ROOT.'configs/env.php';

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
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(ROOT.'controllers/');				// controllers 
	$Bootstrap->addAutoloadPath(ROOT.'controllers/_components/');	// components 
	$Bootstrap->addAutoloadPath(ROOT.'views/_helpers/');			// helpers 
	
	$Bootstrap->loadConfigs(ROOT.'configs/');						// config
	
	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();

	$Bootstrap->dispatch();
