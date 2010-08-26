<?php
	// Configurations
	setlocale(LC_ALL, 'eng_EN', 'eng');
	Config::set('date.short', 		'%m/%d/%Y');
	Config::set('date.medium', 		'%a, %b %d, %y');
	Config::set('date.long', 		'%A, %B %d, %Y');

	Config::set('datetime.short', 	'%m/%d/%Y %I:%M %p');
	Config::set('datetime.medium', 	'%a, %d %b %y, %I:%M %p');
	Config::set('datetime.long', 	'%A, %d %B %Y, %I:%M %p');
	
	// Définitions
	$i18n = array();

	$i18n['or']						= "or";
	$i18n['cancel']					= "Cancel";