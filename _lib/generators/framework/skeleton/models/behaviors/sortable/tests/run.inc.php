<?php
	$ROOT = dirname(__FILE__).'/../../../../';

	$_SERVER['DOCTRINE_DIR'] = $ROOT.'_lib/vendors/doctrine/';
	
	require_once $ROOT.'_lib/tests/doctrine/bootstrap.php';
	
	spl_autoload_register(array('Doctrine', 'extensionsAutoload'));
	Doctrine::setExtensionsPath($ROOT.'_lib/tests/doctrine/');
	$manager = Doctrine_Manager::getInstance()->registerExtension('SortableBehavior', '../');
	
	require_once 'SortableTestCase.inc.php';

	$test = new DoctrineTest();
	$test->addTestCase(new Doctrine_SortableTestCase());
	exit($test->run() ? 0 : 1);