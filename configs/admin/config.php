<?php
	$configs = array();

	// Par défaut ------------------------------------------------------------
	$configs['default'] = array(
	    'pagination.perpage'   	=> 10,
		'pagination.filter'		=> array('page', 'orderby',	'dir', 'search'),
	);

	// Développement ---------------------------------------------------------
	$configs['dev'] = array(
	);

	// Production ------------------------------------------------------------
	$configs['prod'] = array(
	);
	
	// Configs ---------------------------------------------------------------