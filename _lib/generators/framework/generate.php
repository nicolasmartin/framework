<?php
	define('ROOT', 	realpath(dirname(__FILE__).'/../../../'));
	define('LIB', 	ROOT.'/_lib');
	require_once LIB.'/core/_includes.php';
	require_once ROOT.'/configs/set.php';
	
	$Generator = new GeneratorFramework();
	$Generator->setOverwriteFramework(true);
	$Generator->generateAll();