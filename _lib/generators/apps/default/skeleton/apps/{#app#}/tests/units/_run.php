<?php
	require_once(dirname(__FILE__).'/_bootstrap.php');
	
	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/test.php');
			// Ajouter les tests ici
		}
	}