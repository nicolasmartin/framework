<?php
	require_once('../../../bootstrap.php');

	$Generator = new GeneratorController('empty', 'admin');

	$Generator->setOverwrite(true);
	$Generator->setProtection(false);

	$Generator->generate();