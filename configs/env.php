<?php
	// Développement
	if ($_SERVER['REMOTE_ADDR'] 		== '127.0.0.1') {
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
?>