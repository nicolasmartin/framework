<?php
	require_once(dirname(__FILE__).'/../core/_functions.php');
	require_once(dirname(__FILE__).'/../core/i18n.php');
	require_once(dirname(__FILE__).'/../i18n.php');
	require_once(dirname(__FILE__).'/../core/Component.php');
	require_once(dirname(__FILE__).'/../Component.php');
	require_once(dirname(__FILE__).'/../core/Dispatcher.php');
	require_once(dirname(__FILE__).'/../Dispatcher.php');
	require_once(dirname(__FILE__).'/../../controllers/_components/Url.php');
	
	require_once(dirname(__FILE__) . '/../vendors/simpletest/autorun.php');

	class TestOfTranslation extends UnitTestCase {
		public $def = array(
			'dog'			=> 'chien',
			'hi %%name%%!'	=> 'salut %%name%% !',
			'url.gallery' 	=> 'galerie'
		);
	
		public function __construct() {
			$Dispatcher = Dispatcher::getInstance();
			$Dispatcher->setApp(null);
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
			$this->assertEqual(i18n::translate('gallery', null, null, 'url'), 'galerie');
			$this->assertEqual(i18n::translate('galerie', null, true, 'url'), 'gallery');
		}	

		public function testUrlTranslation() {
			$url = UrlComponent::path('/gallery/index/');
			$this->assertEqual($url, '/galerie/index/');
		}	

		public function tearDown() {
			
		}
	}