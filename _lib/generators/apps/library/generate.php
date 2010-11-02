<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('library');
	$Generator->setOverwrite(true);
	$Generator->generate();