<?php
	// Tests functionnels
	if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' && isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT'] == 'Functional test') {
		define('ENV', 'test');
		ini_set('display_errors', 1);
		
	// Développement
	} else if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
		define('ENV', 'dev');
		ini_set('display_errors', 1);
		
	// Production
	} else if (preg_match('~(www\.)?domain.com~', $_SERVER['SERVER_NAME'])) {
		define('ENV', 'prod');
		ini_set('display_errors', 0);
	
	// Rien
	} else {
		throw new Exception('Aucun environnement disponible.');	
	}
