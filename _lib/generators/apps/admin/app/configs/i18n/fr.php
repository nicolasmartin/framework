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
	
	// Actions
	$i18n['url.add'] 	= 'ajouter';
	$i18n['url.edit'] 	= 'editer';
	$i18n['url.delete'] = 'supprimer';
	$i18n['url.list'] 	= 'lister';
	$i18n['url.show'] 	= 'resumer';
	$i18n['url.cancel'] = 'annuler';