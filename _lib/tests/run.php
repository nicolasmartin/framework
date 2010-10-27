<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	
	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/filterComponent.php');
			$this->addFile(dirname(__FILE__).'/validatorComponent.php');
            $this->addFile(dirname(__FILE__).'/i18n.php');
            $this->addFile(dirname(__FILE__).'/urlComponent.php');
            $this->addFile(dirname(__FILE__).'/formHelper.php');
            $this->addFile(dirname(__FILE__).'/generatorHelper.php');
			$this->addFile(dirname(__FILE__).'/request.php');
			// Ajouter les tests ici
		}
	}