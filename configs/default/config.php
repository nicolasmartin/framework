<?php
	$configs = array();

	// Par défaut -----------------------------------------------------------
	$configs['default'] = array(
		'su.username' 		=> 'admin',
		'su.password' 		=> '1087f18bf25e2837fecc316f9ead454bd5f6cef7',

		'project.owner' 	=> 'Nom du propriétaire',
		'project.name' 		=> 'Nom du site',
		'project.desc' 		=> 'Description du site',
		'project.url' 		=> 'http://www.domain.com',
		'project.domain' 	=> 'domain.com',
		'project.email' 	=> 'contact@domain.com',
		
		'uploads.path'		=> 'uploads/',
		
		'cache.pictures'	=> true,
		'code.xhtml'		=> true,
	);

	// Développement ---------------------------------------------------------
	$configs['dev'] = array(
		'db.host'			=> 'localhost',
		'db.name'			=> 'fw',
		'db.username'		=> 'root',
		'db.password'		=> 'root',
		
		'project.url' 		=> 'http://domain.localhost',
		'project.email' 	=> 'jay@jaysalvat.com',
		
		'cache.pictures'	=> false,
	);
	
	// Tests ------------------------------------------------------------
	$configs['test'] = array(
		'db.host'			=> 'localhost',
		'db.name'			=> 'fw_test',
		'db.username'		=> 'root',
		'db.password'		=> 'root',
		
		'project.url' 		=> 'http://domain.localhost',
		'project.email' 	=> 'jay@jaysalvat.com',
		
		'su.username' 		=> 'test',
		'su.password' 		=> 'ff90fc86a9aa0f1dcfa217183a233ce7e8d9bc34',
	);

	// Production ------------------------------------------------------------
	$configs['prod'] = array(
		'db.host'			=> '',
		'db.name'			=> '',
		'db.username'		=> '',
		'db.password'		=> '',
	);

	// Configs ----------------------------------------------------------------
	header('Content-type: text/html; charset=UTF-8');

	date_default_timezone_set('Europe/Paris');	
	error_reporting(E_ALL);
	
	ini_set('register_globals', 	'off');
	ini_set('magic_quotes_gpc', 	'off');
	ini_set('session.use_trans_sid','off');
	ini_set('upload_max_filesize', 	'10M');
	ini_set('post_max_size', 		'10M');
	 