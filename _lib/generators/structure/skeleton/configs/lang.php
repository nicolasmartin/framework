<?php
    // Langues par subdomain
	if (preg_match('~^(en)\.~', $_SERVER['SERVER_NAME'], $match)) {
		define('LANG', $match[1]);
	
	// Langue par défault
	} else {
		define('LANG', 'fr');
	}
