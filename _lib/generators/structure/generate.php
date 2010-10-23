<?php
	header('Content-type: text/html; charset=UTF-8');
	
	define('ROOT', 	realpath(dirname(__FILE__).'/../../../'));
	define('LIB', 	ROOT.'/_lib');

	require_once LIB.'/core/_includes.php';
	
	$Generator = new GeneratorStructure();
	$Generator->setOverwriteStructure(true);
	$Generator->generateAll();