<?php
	require_once 'bootstrap.php';
	
	define('THEME_PATH', dirname(__FILE__).'/default');
	
	$Generator = new Generator('admin', 'users', 'user', THEME_PATH);
	$Generator->addPack('users');
	$Generator->setOverwrite(false);
	$Generator->setProtection(true);
	$Generator->setSettings(array(
		'model'			=> 'User',
		'collection'	=> 'Users',
		'singular'		=> "utilisateur",
		'plural'		=> "utilisateurs",
		'male'			=> true,
		'a' 			=> "un ",
		'the' 			=> "l'",
		'this' 			=> "cet ",
	));
	$Generator->setExclude(array(
		'id', 
		'slug',
		'created_at', 
		'updated_at'
	));
	$Generator->setMapping(array(
		'name' 		=> 'nom',
		'firstname'	=> 'prénom',
		'username' 	=> 'identifiant',
		'password' 	=> 'mot de passe',
		'logged_at'	=> 'connecté le',
		'status'	=> 'statut'
	));
	$Generator->setVerbose(true);
	$Generator->generate();