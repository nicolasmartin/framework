<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorController('library', 'test2');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generate();