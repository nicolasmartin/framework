<?php
    define('ROOT', dirname(__FILE__).'/../');
    require_once(ROOT.'_lib/core/_includes.php');
  
    $default = array(
        'src'       => false,
        'width'     => 200,
        'height'    => false,
        'mode'      => false,
    );
    extract(array_merge($default, $_GET));
  
    $src = ROOT.'www/'.$src;
    
    if (!$height) {
        $height = $width;
    }
    
    $Image = new Image($src);
    if ($mode == 'crop') {
        $Image->thumbnail($width, $height);
    } elseif ($mode == 'zoom') {
        $Image->zoom($width, $height);    
    } else {
        $Image->resize($width, $height);
    }
    $Image->show();
    flush();
