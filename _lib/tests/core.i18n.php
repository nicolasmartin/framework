<?php
	require_once(dirname(__FILE__).'/_bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfI18n extends UnitTestCase {
		public $def = array(
			'dog'			    => 'chien',
			'hi %%name%%!'	    => 'salut %%name%% !',
			'url.app' 	        => 'application',
			'url.controller'    => 'controlleur',
			'url.action' 	    => 'action',
			'url.param'         => 'parametre',
			'url.value'         => 'valeur'
		);
	
		public function __construct() {
			$Dispatcher = Dispatcher::getInstance();
			$Dispatcher->setApp('app');
			$Dispatcher->setControllerName('myController');
			$Dispatcher->setActionName('myAction');
			
			i18n::setCulture('fr');
			i18n::addDefinitions($this->def);	
		}

		public function setUp() {	
		}

		public function testTranslation() {
			$this->assertEqual(i18n::translate('dog'), 'chien');	
			$this->assertEqual(i18n::translate('hi %%name%%!', array('name' => 'Jay')), 'salut Jay !');
		}

		public function testReverseTranslation() {
			$this->assertEqual(i18n::translate('chien', null, true), 'dog');		
			$this->assertEqual(i18n::translate('salut Jay !', array('name' => 'Jay'), true), 'hi %%name%%!');
		}			

		public function testPrefixTranslation() {
			$this->assertEqual(i18n::translate('app', null, null, 'url'), 'application');
			$this->assertEqual(i18n::translate('application', null, true, 'url'), 'app');
		}	

		public function testUrlTranslation() {
			$url = UrlComponent::path('/app/controller/action/param/value');
			$this->assertEqual($url, '/application/controlleur/action/param/value');
		}	

		public function tearDown() {	
		}
	}