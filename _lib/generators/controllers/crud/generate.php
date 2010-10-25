<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorController('admin', 'tests', 'library');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generateAll();