<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('default');
	$Generator->setOverwrite(true);
	$Generator->generate();