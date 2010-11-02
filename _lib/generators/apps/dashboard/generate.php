<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('dashboard');
	$Generator->setOverwrite(true);
	$Generator->generate();