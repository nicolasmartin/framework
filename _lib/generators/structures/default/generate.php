<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure();
	$Generator->setOverwrite(true);
	$Generator->generate();