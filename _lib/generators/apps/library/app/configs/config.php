<?php
	$configs = array();

	// Par défaut ------------------------------------------------------------
	$configs['default'] = array(
	    'pagination.chunk'   	=> 5,
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