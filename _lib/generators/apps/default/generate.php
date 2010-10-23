<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorApp('default');
	
	$Generator->setOverwriteApp(true);

	$Generator->generateAll();