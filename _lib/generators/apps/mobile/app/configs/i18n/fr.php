<?php
	// Configurations
	setlocale(LC_ALL, 'fr_FR', 'fra');
	Config::set('date.short', 		'%d/%m/%Y');
	Config::set('date.medium', 		'%a %d %b %y');
	Config::set('date.long', 		'%A %d %B %Y');

	Config::set('datetime.short', 	'%d/%m/%Y %H:%M');
	Config::set('datetime.medium', 	'%a %d %b %y, %H:%M');
	Config::set('datetime.long', 	'%A %d %B %Y, %H:%M');

	// Définitions	
	$i18n = array();
	
	// Traduction dans les url
	$i18n['url.users'] 				= 'utilisateurs';

	// Traductions
	$i18n['or']						= "ou";
	$i18n['cancel']					= "Annuler";