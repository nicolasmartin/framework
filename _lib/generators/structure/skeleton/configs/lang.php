<?php
    // Langues par subdomain
	if (preg_match('~^(en)\.~', $_SERVER['SERVER_NAME'], $match)) {
		define('LANG', $match[1]);
		setlocale(LC_ALL, 'english');
	
	// Langue par défault
	} else {
		define('LANG', 'fr');
		setlocale(LC_ALL, 'french');
	}
