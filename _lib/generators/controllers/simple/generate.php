<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorController('default', 'test2');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generateAll();