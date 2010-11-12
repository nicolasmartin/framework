<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('test');
	$Generator->setOverwrite(true);
	$Generator->generate();