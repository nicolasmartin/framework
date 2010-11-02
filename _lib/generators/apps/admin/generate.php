<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('admin');
	$Generator->setOverwrite(true);
	$Generator->generate();