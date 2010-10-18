<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorController('admin', 'default', 'sandbox');
/*	$Generator->setSettings(array(
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
	));*/
	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generateAll();