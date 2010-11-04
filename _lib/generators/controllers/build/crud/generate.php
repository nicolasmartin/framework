<?php
	require_once('../../../bootstrap.php');

	$Generator = new GeneratorController('sandboxes', 'admin', 'sandbox');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generate();