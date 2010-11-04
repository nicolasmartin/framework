<?php
	require_once('../../../bootstrap.php');

	$Generator = new GeneratorController('test', 'admin', 'sandbox');
	$Generator->setVar('model',			"Item");
	$Generator->setVar('collection',	"Items");
	$Generator->setVar('singular',		"élément");
	$Generator->setVar('plural',		"éléments");
	$Generator->setVar('a',				"un élément");
	$Generator->setVar('the',			"l'élément");
	$Generator->setVar('this',			"cet élément");
	$Generator->setVar('female',		"e");
	$Generator->setOverwrite(true);
	$Generator->setProtection(false);

	$Generator->generate();