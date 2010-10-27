<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorApp('library2');
	
	$Generator->setOverwriteApp(true);
	$Generator->setOverwriteWww(true);
	$Generator->setOverwriteModels(true);

	$Generator->generateAll();