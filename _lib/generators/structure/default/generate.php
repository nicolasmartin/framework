<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure();
	$Generator->setOverwriteStructure(true);
	$Generator->generateAll();