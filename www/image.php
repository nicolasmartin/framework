<?php
    define('ROOT', dirname(__FILE__).'/../');
   // require_once ROOT.'_lib/components/Image.php';
	require_once ROOT.'_lib/core/_includes.php';

	// Environnements
	include ROOT.'configs/env.php';

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();	
	$Bootstrap->setEnv(ENV);
	$Bootstrap->loadConfigs(ROOT.'configs/default/');
  
    $default = array(
        'src'       => false,
        'width'     => 200,
        'height'    => false,
        'mode'      => false,
    );
    extract(array_merge($default, $_GET));
 
    if (!$height) {
         $height = $width;
     }

    $cache = ROOT.'cache/'.sha1($src.$width.$height.$mode);
    $life  = '-1 month';
    
    if (file_exists($cache) && ($life == false || filemtime($cache) > strtotime($life))) {
    	$info = getimagesize($cache);
    	header('Content-type:'.$info['mime']);
    	readfile($cache);
    	exit();
    } else {
        $Image = new Image(ROOT.'www/'.$src);
        if ($mode == 'crop') {
            $Image->thumbnail($width, $height);
        } elseif ($mode == 'zoom') {
            $Image->zoom($width, $height);    
        } else {
            $Image->resize($width, $height);
        }
        $Image->save($cache);
    }
    $Image->show();
    flush();
