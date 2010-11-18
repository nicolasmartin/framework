<?php
	require_once('../../../bootstrap.php');

	$Generator = new GeneratorController('empty', 'default');

	$Generator->setOverwrite(true);
	$Generator->setProtection(false);

	$Generator->generate();