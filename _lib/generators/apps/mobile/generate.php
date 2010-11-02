<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('mobile');
	$Generator->setOverwrite(true);
	$Generator->generate();