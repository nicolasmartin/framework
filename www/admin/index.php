<?
	define('ROOT', 			realpath(dirname(__FILE__).'/../../')."/");
	define('CONTROLLERS', 	ROOT.'controllers/admin/');
	define('VIEWS', 		ROOT.'views/admin/');
	define('MODELS', 		ROOT.'models/');
	
	require_once ROOT.'_lib/core/_includes.php';

	// Vendors
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';
	require_once ROOT.'_lib/vendors/image/class.image.php';
	require_once ROOT.'_lib/vendors/mailer/class.mailer.php';

	// Environnements
	include ROOT.'configs/env.php';

	// Langues
	i18n::setCulture('fr');
	i18n::addDefinitionPath(ROOT.'configs/i18n/');
	i18n::addDefinitionPath(ROOT.'configs/admin/i18n/');
	i18n::loadDefinitions();

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultController('default/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(ROOT.'controllers/admin/');				// controllers app
	$Bootstrap->addAutoloadPath(ROOT.'controllers/admin/_components/');	// components app
	$Bootstrap->addAutoloadPath(ROOT.'controllers/_components/');		// components project
	$Bootstrap->addAutoloadPath(ROOT.'views/admin/_helpers/');			// helpers app
	$Bootstrap->addAutoloadPath(ROOT.'views/_helpers/');				// helpers project
	
	$Bootstrap->loadConfigs(ROOT.'configs/');							// config project
	$Bootstrap->loadConfigs(ROOT.'configs/admin/');						// config app

	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
	
	$Bootstrap->dispatch();
