<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorApp('mobile');
	
	$Generator->setOverwriteApp(true);

	$Generator->generateAll();