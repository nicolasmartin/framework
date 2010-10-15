<?php
	header('Content-type: text/html; charset=UTF-8');

	date_default_timezone_set('Europe/Paris');	
	error_reporting(E_ALL);
	
	ini_set('register_globals', 	'off');
	ini_set('magic_quotes_gpc', 	'off');
	ini_set('session.use_trans_sid','off');
	ini_set('upload_max_filesize', 	'10M');
	ini_set('post_max_size', 		'10M');
