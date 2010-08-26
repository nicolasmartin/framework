<?php
	// Configurations
	setlocale(LC_ALL, 'fr_FR');
	Config::set('date.format.short', 	'{dd}/{mm}/{YYYY}');
	Config::set('date.format.long', 	'{day} {montn} {YYYY}');
	
	// Définitions
	$i18n = array();
	
	// Actions
	$i18n['url.add'] 	= 'ajouter';
	$i18n['url.edit'] 	= 'editer';
	$i18n['url.delete'] = 'supprimer';
	$i18n['url.list'] 	= 'lister';
	$i18n['url.cancel'] = 'annuler';