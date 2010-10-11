<?php
	require_once 'bootstrap.php';
	
	define('THEME',			'default');
	define('APP', 			'admin');
	define('CONTROLLER', 	'Tests');
	define('MODEL', 		'Test');
	define('OVERWRITE', 	true);
	
	$settings = array(
		'model'			=> 'Element',
		'collection'	=> 'Elements',
		'singular'		=> "élément",
		'plural'		=> "éléments",
		'masc'			=> true,
			'a' 		=> "un",
			'the' 		=> "l'",
			'this' 		=> "cet",
		'exclude'		=> array('id', 'slug', 'created_at', 'updated_at')
	);

	$template_path = dirname(__FILE__).'/'.THEME.'/';


	// Créé les controllers
	$class = '';
	foreach(array(
		'index.tpl.php',
		'show.tpl.php',
		'add.tpl.php',
		'edit.tpl.php',
		'delete.tpl.php'
	) as $file) {
		$View = new View($template_path.'controllers/'.$file, null, false);
		$View->set('app', 			APP);
		$View->set('controller', 	CONTROLLER);
		$View->set('model', 		MODEL);
		$View->set('settings', 		$settings);
	
		$class .= $View->render();
	}
	
	$Base = new View($template_path.'controllers/base.tpl.php', null, false);
	$Base->set('app', 			APP);
	$Base->set('controller', 	CONTROLLER);
	$Base->set('model', 		MODEL);
	$Base->set('settings', 		$settings);
	$Base->set('class', 			$class);
	
	$generated = $Base->render();
	$generated = ( str_replace('[?', '<?', $generated) );
	$generated = ( str_replace('?]', '?>', $generated) );

	if (APP == '') {
		$path = CONTROLLERS.'default/'.strtolower(CONTROLLER).'.php';
	} else {
		$path = CONTROLLERS.strtolower(APP).'/'.strtolower(CONTROLLER).'.php';
	}
	
	if (file_exists($path) && OVERWRITE === false) {
		throw new Exception('Le controller '.$path.' existe déjà.');	
	} 
		
	file_put_contents($path, $generated);
	echo "Controller généré dans ".$path, '<br/>';

	
	// Créé les vues
	foreach(array(
		'index.tpl.php',
		'edit.tpl.php',
		'show.tpl.php',
		'delete.tpl.php',
	) as $file) {
		$View = new View($template_path.'views/'.$file, null, false);
		$View->set('app', 			APP);
		$View->set('controller', 	CONTROLLER);
		$View->set('model', 		MODEL);
		$View->set('settings', 		$settings);
	
		$generated = $View->render();
		$generated = ( str_replace('[?', '<?', $generated) );
		$generated = ( str_replace('?]', '?>', $generated) );
	
		if (APP == '') {
			$path = VIEWS.'default/'.strtolower(CONTROLLER).'/'.$file;
		} else {
			$path = VIEWS.strtolower(APP).'/'.strtolower(CONTROLLER).'/'.$file;
		}

		if (!file_exists(dirname($path))) {
			mkdir(dirname($path));
		}
		
		if (file_exists($path) && OVERWRITE === false) {
			throw new Exception('La vue '.$path.' existe déjà.');	
		}

		file_put_contents($path, $generated);
		echo "Vue générée dans ".$path, '<br/>';
	}
	