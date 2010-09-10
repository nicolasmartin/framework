<?php
	define('ROOT', 			realpath(dirname(__FILE__).'/../../')."/");
	define('CONTROLLERS', 	ROOT.'controllers/admin/');
	define('VIEWS', 		ROOT.'views/admin/');
	define('MODELS', 		ROOT.'models/');
	
	require_once ROOT.'_lib/core/_includes.php';
	require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';

	// Environnements
	include ROOT.'configs/env.php';

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);
	
	$Bootstrap->addAutoloadPath(ROOT.'controllers/admin/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/admin/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'controllers/default/_components/');
	$Bootstrap->addAutoloadPath(ROOT.'views/admin/_helpers/');
	$Bootstrap->addAutoloadPath(ROOT.'views/default/_helpers/');
	
	$Bootstrap->loadConfigs(ROOT.'configs/default/');
	$Bootstrap->loadConfigs(ROOT.'configs/admin/');

	$Bootstrap->addModelPath(ROOT.'models/generated/');
	$Bootstrap->addModelPath(ROOT.'models/');
	$Bootstrap->setDoctrine();
	
	$Bootstrap->dispatch();
