<?php
	require_once(dirname(__FILE__).'/_bootstrap.php');
	
	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/core.request.php');
            $this->addFile(dirname(__FILE__).'/core.i18n.php');
			$this->addFile(dirname(__FILE__).'/component.filter.php');
			$this->addFile(dirname(__FILE__).'/component.validator.php');
            $this->addFile(dirname(__FILE__).'/component.url.php');
            $this->addFile(dirname(__FILE__).'/helper.form.php');
            $this->addFile(dirname(__FILE__).'/helper.generator.php');

			// Ajouter les tests ici
		}
	}