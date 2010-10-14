<?php
	require_once 'bootstrap.php';
	
	define('THEME_PATH', dirname(__FILE__).'/default');
	
	$Generator = new Generator('sandbox', 'default', 'sandbox', THEME_PATH);
	$Generator->addPack('init');
	
	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);
	
	$Generator->setSettings(array(
		'model'			=> 'Sandbox',
		'collection'	=> 'Sandboxes',
		'singular'		=> "élément",
		'plural'		=> "éléments",
		'male'			=> true,
		'this' 			=> "cet ",
		'the' 			=> "l'",
		'a' 			=> "un ",
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