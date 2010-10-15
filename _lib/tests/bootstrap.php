<?php
    define('ROOT', 			realpath(dirname(__FILE__).'/../../'));
    define('LIB', 			ROOT.'/_lib');
    define('MODELS',		ROOT.'/models');	

    require_once LIB.'/core/_includes.php';
    require_once LIB.'/vendors/doctrine/Doctrine.php';
    require_once ROOT.'/configs/set.php';


	require_once(LIB.'/vendors/simpletest/autorun.php');

	// Environnement
	define('ENV', 'test');

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setEnv(ENV);

	$Bootstrap->loadConfigs(ROOT.'/configs/');
	
	$Bootstrap->addModelPath(MODELS.'/generated/');
	$Bootstrap->addModelPath(MODELS);
	$Bootstrap->setDoctrine();
	
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);
