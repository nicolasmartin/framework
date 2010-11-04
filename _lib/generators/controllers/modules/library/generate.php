<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('admin', 'library2');

	$Generator->setOverwrite(true);
	$Generator->generate();