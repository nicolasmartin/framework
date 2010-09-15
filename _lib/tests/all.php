<?php
	define('ROOT', dirname(__FILE__).'/../../');
	require_once(ROOT.'_lib/vendors/simpletest/autorun.php');
	
	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/test.php');
			$this->addFile(dirname(__FILE__).'/filters.php');
			$this->addFile(dirname(__FILE__).'/translations.php');
		}
	}