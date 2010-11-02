<?php
	require_once('../../bootstrap.php');

	$Generator = new GeneratorController('admin', 'sandbox', 'sandbox');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generateAll();