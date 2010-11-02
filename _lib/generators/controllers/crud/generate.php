<?php
	require_once('../../bootstrap.php');

	$Generator = new GeneratorController('sandboxes', 'library', 'admin');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);
	
	$Generator->setProtection(false);

	$Generator->generate();