<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	
	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/filters.php');
            $this->addFile(dirname(__FILE__).'/i18n.php');
            $this->addFile(dirname(__FILE__).'/urlComponent.php');
            $this->addFile(dirname(__FILE__).'/formHelper.php');
			// Ajouter les tests ici
		}
	}