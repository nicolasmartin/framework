<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorStructure('admin');
	$Generator->setOverwrite(false);
	$Generator->generate();