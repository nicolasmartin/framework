<?php
	require_once('../../../bootstrap.php');
	
	$Generator = new GeneratorStructure('admin', 'library');
	$Generator->setOverwrite(true);
	$Generator->generate();