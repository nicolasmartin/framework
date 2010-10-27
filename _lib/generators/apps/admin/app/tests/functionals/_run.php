<?php
	require_once(dirname(__FILE__).'/_bootstrap.php');

	define('DOMAIN', 		Config::get('project.url'));
	define('USER_AGENT', 	'Functional test');
	define('SU_USERNAME', 	'test');
	define('SU_PASSWORD', 	'f10unctional');

	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/test.php');
            // Ajouter les tests ici
		}
	}

	class FunctionalWebTestCase extends WebTestCase {
		function setUp() {
			$this->addHeader("User-Agent:".USER_AGENT);
			parent::setUp();
		}
	}
	