<?php
	header('Content-type: text/html; charset=UTF-8');

	date_default_timezone_set('Europe/Paris');	
	error_reporting(E_ALL);

	ini_set('register_globals', 	'off');
	ini_set('magic_quotes_gpc', 	'off');
	ini_set('session.use_trans_sid','off');
	ini_set('upload_max_filesize', 	'10M');
	ini_set('post_max_size', 		'10M');
	ini_set('memory_limit',         '64M');

	setlocale(LC_ALL, 'fr_FR', 'fra');
	Config::set('date.short', 		'%d/%m/%Y');
	Config::set('date.medium', 		'%a %d %b %y');
	Config::set('date.long', 		'%A %d %B %Y');

	Config::set('datetime.short', 	'%d/%m/%Y %H:%M');
	Config::set('datetime.medium', 	'%a %d %b %y, %H:%M');
	Config::set('datetime.long', 	'%A %d %B %Y, %H:%M');