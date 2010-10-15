<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorApp('admin');
	
	$Generator->setOverwriteApp(true);
	$Generator->setOverwriteApp(true);

	$Generator->generateAll();