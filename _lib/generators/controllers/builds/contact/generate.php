<?php
	require_once('../../../bootstrap.php');

	$Generator = new GeneratorController('contact', 'default', 'contact');
	$Generator->setOverwrite(true);
	$Generator->setProtection(false);
	$Generator->generate();