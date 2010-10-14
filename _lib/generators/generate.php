<?php
	require_once 'bootstrap.php';
	
	define('THEME_PATH', dirname(__FILE__).'/default');
	
	$Generator = new Generator('admin', 'tests', 'test', THEME_PATH);
	//$Generator->addPack('users');
	$Generator->setOverwrite(true);
	$Generator->setProtection(true);
	$Generator->setSettings(array(
		'model'			=> 'Test',
		'collection'	=> 'Tests',
		'singular'		=> "élément",
		'plural'		=> "éléments",
		'male'			=> true,
		'a' 			=> "un ",
		'the' 			=> "l'",
		'this' 			=> "cet ",
	));
	$Generator->setExclude(array(
		'id', 
		'slug',
		'created_at', 
		'updated_at'
	));
	$Generator->setMapping(array(
		'name' 		=> 'nom',
		'firstname'	=> 'prénom',
	));
	$Generator->setVerbose(true);
	$Generator->generateAll();