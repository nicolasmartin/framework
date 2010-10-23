<?php
	require_once('../../bootstrap.php');
	
	$Generator = new GeneratorController('library', 'test', 'library');

	$Generator->setOverwriteController(true);
	$Generator->setOverwriteViews(true);
	$Generator->setOverwritePartials(true);

	$Generator->setProtection(false);
	
	//$Generator->addPack('users');
	
    // $Generator->setSettings(array(
    //  'model'         => 'Picture',
    //  'collection'    => 'Pictures',
    //  'singular'      => "image",
    //  'plural'        => "images",
    //  'male'          => false,
    //  'this'          => "cette ",
    //  'the'           => "l'",
    //  'a'             => "une ",
    // ));
    $Generator->setExclude(array(
     'id', 
     'slug',
     'created_at', 
     'updated_at'
    ));
    $Generator->setMapping(array(
     'path'      => 'chemin',
    ));
	
	$Generator->generateAll();