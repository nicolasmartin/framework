<?php
	require_once('../../bootstrap.php');

	$Generator = new GeneratorController('library2', 'tests', 'library');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);
	
	$Generator->setExclude(array(
		'id',
		'slug',
	));

	$Generator->generateAll();