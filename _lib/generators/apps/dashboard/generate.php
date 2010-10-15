<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorApp('dashboard');
	
	$Generator->setOverwriteApp(true);
	$Generator->setOverwriteApp(true);

	$Generator->generateAll();