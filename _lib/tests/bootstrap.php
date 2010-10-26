<?php
    define('ROOT', 			realpath(dirname(__FILE__).'/../../'));
    define('LIB', 			ROOT.'/_lib');
    define('MODELS',		ROOT.'/models');	

    require_once LIB.'/core/_includes.php';
    require_once LIB.'/vendors/doctrine/Doctrine.php';
    require_once ROOT.'/configs/set.php';

	require_once(LIB.'/vendors/simpletest/autorun.php');

	class MyHtmlReporter extends HtmlReporter {
		function __construct() {
			parent::__construct('UTF-8');
		}
		
		protected function clear($matches) {
			return "[".htmlentities($matches[1], ENT_COMPAT, 'UTF-8')."]";
		}
		
		protected function simplify($message) {
			return str_replace(dirname(str_replace('/', '\\', $_SERVER['SCRIPT_FILENAME'])), '', $message);
		}
		
		function paintFail($string) {
			$string = $this->simplify($string);
			parent::paintFail($string);
		}
		
		protected function htmlEntities($message) {
			$message = $this->simplify($message);
			$message = utf8_encode($message);
			$message = preg_replace('~ with \[~', '<br/>[', $message);
			$message = preg_replace('~\] and \[~', ']<br/>[', $message);
			$message = preg_replace('~\] at \[~', ']<br/>[', $message);
			$message = preg_replace_callback(
				'~\[(.*?)\]~', array('self', 'clear'), $message
			);
			return $message;
		}
	}
	SimpleTest::prefer(new MyHtmlReporter());

	// Environnement
	define('ENV', 'test');

	// Bootstrap
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setEnv(ENV);

	$Bootstrap->loadConfigs(ROOT.'/configs/');
	
	$Bootstrap->addModelPath(MODELS.'/bases/');
	$Bootstrap->addModelPath(MODELS);
	$Bootstrap->setDoctrine();
	
	$Bootstrap = Bootstrap::getInstance();
	$Bootstrap->setDefaultPath('default/index');	
	$Bootstrap->setEnv(ENV);
