<?php
$startTime = time();

error_reporting(E_ALL | E_STRICT);
ini_set('max_execution_time', 900);
ini_set('date.timezone', 'GMT+0');

define('DOCTRINE_DIR', $_SERVER['DOCTRINE_DIR']);

require_once(DOCTRINE_DIR . '/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine', 'modelsAutoload'));

require_once('DoctrineTest.php');
spl_autoload_register(array('DoctrineTest', 'autoload'));