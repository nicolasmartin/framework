<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfUrlComponent extends UnitTestCase {
		public $Dispatcher;
		
		public function __construct() {
			$_SERVER['SCRIPT_NAME'] = '/myapp/index.php';
			$this->Dispatcher = Dispatcher::getInstance();
			$this->Dispatcher->setUrl('mycontroller/myaction/p1/1/p2/2/p3/3');
		}

		public function setUp() {	
		}

		public function testUrlEmpty() {
			$this->assertEqual(UrlComponent::url(), 'http://'.$_SERVER['SERVER_NAME'].'/myapp/mycontroller/myaction/p1/1/p2/2/p3/3');
		}

		public function testUrl() {
			$this->assertEqual(UrlComponent::url(array(
				'action' => 'newaction'
			)), 'http://'.$_SERVER['SERVER_NAME'].'/myapp/mycontroller/newaction');
		}

		public function testBlacklist() {
			$this->assertEqual(UrlComponent::blacklist(array('p1', 'p2')), '/myapp/mycontroller/myaction/p3/3');
		}

		public function testWhitelist() {
			$this->assertEqual(UrlComponent::whitelist(array()), '/myapp/mycontroller/myaction');
			$this->assertEqual(UrlComponent::whitelist(array('p1')), '/myapp/mycontroller/myaction/p1/1');
			$this->assertEqual(UrlComponent::whitelist(array('p1', 'p2')), '/myapp/mycontroller/myaction/p1/1/p2/2');
			$this->assertEqual(UrlComponent::whitelist(array('p1', 'p2', 'p3')), '/myapp/mycontroller/myaction/p1/1/p2/2/p3/3');
		}
		
		public function testPathEmpty() {
			$this->assertEqual(UrlComponent::path(), '/myapp/mycontroller/myaction/p1/1/p2/2/p3/3');
			$this->assertEqual(UrlComponent::path('/'), '/');
		}
		
		public function testPathWithArray() {
			$this->assertEqual(UrlComponent::path(array(
				'params' => array(
					'newp1' => 'a',
					'newp2' => 'b'
				)
			)), '/myapp/mycontroller/myaction/newp1/a/newp2/b');
			
			$this->assertEqual(UrlComponent::path(array(
				'params' => array(
					'newp1' => 'a',
					'newp2' => 'b'
				)
			)), '/myapp/mycontroller/myaction/newp1/a/newp2/b');
			
			$this->assertEqual(UrlComponent::path(array(
				'action' => 'newaction'
			)), '/myapp/mycontroller/newaction');
			
			$this->assertEqual(UrlComponent::path(array(
				'controller' => 'newcontroller'
			)), '/myapp/newcontroller');
			
			$this->assertEqual(UrlComponent::path(array(
				'app' => 'newapp'
			)), '/newapp');
			
			$this->assertEqual(UrlComponent::path(array(
				'app' => 'newapp',
				'params' => array(
					'newp1' => 'a',
					'newp2' => 'b'
				)
			)), '/newapp/default/index/newp1/a/newp2/b');
			
			$this->assertEqual(UrlComponent::path(array(
				'controller' => 'newcontroller',
				'params' => array(
					'newp1' => 'a',
					'newp2' => 'b'
				)
			)), '/myapp/newcontroller/index/newp1/a/newp2/b');
			
			$this->assertEqual(UrlComponent::path(array(
				'controller' => 'newcontroller',
				'action' => 'newaction'
			)), '/myapp/newcontroller/newaction');
			
			$this->assertEqual(UrlComponent::path(array(
				'app' => 'newapp',
				'controller' => 'newcontroller',
				'action' => 'newaction'
			)), '/newapp/newcontroller/newaction');
			
			$this->assertEqual(UrlComponent::path(array(
				'app' => 'newapp',
				'controller' => 'newcontroller',
				'action' => 'newaction',
				'params' => array(
					'newp1' => 'a',
					'newp2' => 'b'
				)
			)), '/newapp/newcontroller/newaction/newp1/a/newp2/b');
		}
		
		public function testPathWithString() {		
			$this->assertEqual(UrlComponent::path('/myapp/default/index'), '/myapp/default/index');
			$this->assertEqual(UrlComponent::path('default/index'), '/myapp/default/index');
		}

		public function testPathWithStringI18N() {	
			i18n::setCulture('fr');
			i18n::addDefinitions(array(
				'url.myapp' 		=> 'monapp',
				'url.mycontroller' 	=> 'moncontroller',
				'url.myaction' 		=> 'monaction',		
			));
				
			$this->assertEqual(UrlComponent::path('/myapp/mycontroller/myaction'), '/monapp/moncontroller/monaction');
			$this->assertEqual(UrlComponent::path('mycontroller/myaction'), '/monapp/moncontroller/monaction');
			$this->assertEqual(UrlComponent::path('/myapp/default/index'), '/monapp/default/index');
			$this->assertEqual(UrlComponent::path('default/index'), '/monapp/default/index');
		}
		
		public function testPathWithDefault() {
			$_SERVER['SCRIPT_NAME'] = '/default/index.php';
			$this->Dispatcher = Dispatcher::getInstance();
			$this->Dispatcher->setUrl('mycontroller/myaction/p1/1/p2/2/p3/3');
			
			$this->assertEqual(UrlComponent::path('default/index'), '/default/index');	
		}

		public function tearDown() {
		}
	}