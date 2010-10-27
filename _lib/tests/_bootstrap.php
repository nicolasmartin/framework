<?php
    define('ROOT', 			realpath(dirname(__FILE__).'/../../'));
    define('LIB', 			ROOT.'/_lib');
    define('MODELS',		ROOT.'/models');	

    require_once LIB.'/core/_includes.php';
    require_once LIB.'/vendors/doctrine/Doctrine.php';
    require_once ROOT.'/configs/set.php';

	require_once(LIB.'/vendors/simpletest/autorun.php');

	class MyHtmlReporter extends HtmlReporter {
		private $old; 
		private $new;
		
		function __construct() {
			parent::__construct('UTF-8');
		}
		
		protected function clear($matches) {
			return "[".htmlentities($matches[1], ENT_COMPAT, 'UTF-8')."]";
		}
		
		function paintFail($message) {
			$message = utf8_encode($message);

			$message = str_replace(str_replace('/', '\\', dirname($_SERVER['SCRIPT_FILENAME'])).'\\', '', $message);
			$message = preg_replace('~ with \[~', 	 '<br/>'.str_repeat('&nbsp;', 10).'[DIFF', 
				$message
			);
			$message = preg_replace('~\] and \[~', 	']<br/>'.str_repeat('&nbsp;', 10).'[DIFF', 
				$message
			);
			$message = preg_replace('~\] at \[~',   ']<br/>In [', $message);
			$message = preg_replace_callback(
				'~\[(.*?)\]~', array('self', 'clear'), $message
			);
			
			preg_match_all('~\[(DIFF(.*?))\]~', $message, $matches);

			if (isset($matches[2][0]) && isset($matches[2][1])) {
				$styles = array(
					'+' => '<ins style="color:blue">%s</ins>',
					'-' => '<del style="color:red">%s</del>',
				);
				$message = str_replace($matches[1][0], '<code>'.htmlDiff($matches[2][1], $matches[2][0], $styles).'</code>', $message);
				$message = str_replace($matches[1][1], '<code>'.htmlDiff($matches[2][0], $matches[2][1], $styles).'</code>', $message);
			}
			
			parent::paintFail($message);	
		}
		
		protected function htmlEntities($message) {
			return $message;
		}
		
		
/*		protected function htmlEntities($message) {
			$message = $this->simplify($message);
			$message = utf8_encode($message);
			
			$message = preg_replace('~ with \[~', '<br/>'.str_repeat('&nbsp;', 10).'[', $message);
			$message = preg_replace('~\] and \[~', ']<br/>'.str_repeat('&nbsp;', 10).'[', $message);
			$message = preg_replace('~\] at \[~', ']<br/>In [', $message);
			$message = preg_replace_callback(
				'~\[(.*?)\]~', array('self', 'clear'), $message
			);
			
			preg_match_all('~\[(.*?)\]~', $message, $matches);
			if (isset($matches[1][0]) && isset($matches[1][1])) {
				$styles = array(
					'+' => '<ins style="color:green">%s</ins>',
					'-' => '<del style="color:red">%s</del>',
				);
				$message = str_replace($matches[1][0], htmlDiff($matches[1][0], $matches[1][1], $styles), $message);
				$message = str_replace($matches[1][1], htmlDiff($matches[1][1], $matches[1][0], $styles), $message);
			}
				
			return $message;
		}*/
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
