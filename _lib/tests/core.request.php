<?php
	require_once(dirname(__FILE__).'/_bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfRequest extends UnitTestCase {
		public function __construct() {
		}

		public function setUp() {	
		}
		
		public function testSingleton() {
			$_GET['value'] = 'get';		
			$Request = Request::getInstance();
			$this->assertIsA($Request, 'Request');
			$this->assertEqual($Request->get('value'), 'get');
			$_GET['value'] = 'other';
			$this->assertEqual($Request->get('value'), 'get');		
		}

		public function testMethods() {
			$_SERVER['REQUEST_METHOD'] = 'POST';
			$Request = new Request();
			$this->assertTrue($Request->isPost());
			$this->assertFalse($Request->isGet());
			$this->assertEqual($Request->method(), 'POST');
			
			$_SERVER['REQUEST_METHOD'] = 'GET';
			$Request = new Request();
			$this->assertFalse($Request->isPost());
			$this->assertTrue($Request->isGet());
			$this->assertEqual($Request->method(), 'GET');

			$this->assertFalse($Request->isAjax());
			$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
			$this->assertTrue($Request->isAjax());
		}
		
		public function testGetter() {
			$_GET['value'] = 'get';		
			$Request = new Request();
			$this->assertEqual($Request->get('value'), 'get');
			$this->assertEqual($Request->get('null', 'default'), 'default');
			
			$_POST['value'] = 'post';		
			$Request = new Request();
			$this->assertEqual($Request->post('value'), 'post');
			$this->assertEqual($Request->post('null', 'default'), 'default');

			$_POST['value'] = 'post';	
			$_GET['value'] 	= 'get';		
			$Request = new Request();
			$this->assertEqual($Request->request('value'), 'post');
						
			$this->assertEqual($Request->post(), $_POST);
			$this->assertEqual($Request->get(), $_GET);
			$this->assertEqual($Request->rawPost(), $_POST);
			$this->assertEqual($Request->rawGet(), $_GET);
		}
		
		public function testSanatize() {
			$_GET['xss'] 	= "hello <script>alert('world')</script>";
			$_GET['xss2'] 	= array("hello <script>alert('world')</script>");
			$Request = new Request();
			
			$this->assertEqual($Request->rawGet('xss'), "hello <script>alert('world')</script>");
			$this->assertEqual($Request->get('xss'), "hello ");
			$this->assertEqual($Request->get('xss2'), array("hello "));
			
			$_POST['xss'] 	= "hello <script>alert('world')</script>";
			$_POST['xss2'] 	= array("hello <script>alert('world')</script>");
			$Request = new Request();
			
			$this->assertEqual($Request->rawPost('xss'), "hello <script>alert('world')</script>");
			$this->assertEqual($Request->post('xss'), "hello ");
			$this->assertEqual($Request->post('xss2'), array("hello "));
			
			$_REQUEST['xss'] 	= "hello <script>alert('world')</script>";
			$_REQUEST['xss2'] 	= array("hello <script>alert('world')</script>");
			$Request = new Request();
			
			$this->assertEqual($Request->rawRequest('xss'), "hello <script>alert('world')</script>");
			$this->assertEqual($Request->request('xss'), "hello ");
			$this->assertEqual($Request->request('xss2'), array("hello "));
		}
		
		public function testSmart() {
			$_GET['_date_day'] 		= '20';
			$_GET['_date_month'] 	= '10';
			$_GET['_date_year'] 	= '2000';

			$Request = new Request();
			$this->assertEqual($Request->get('date'), '2000-10-20');
			$this->assertNull($Request->get('_date_day'));
			$this->assertNull($Request->get('_date_month'));
			$this->assertNull($Request->get('_date_year'));
			
			$_GET['_date_day'] 		= '21';
			$_GET['_date_month'] 	= '11';
			$_GET['_date_year'] 	= '2001';
			$_GET['_date_hour'] 	= '12';
			$_GET['_date_minutes'] 	= '24';
			
			$Request = new Request();
			$this->assertEqual($Request->get('date'), '2001-11-21 12:24:00');
			$this->assertNull($Request->get('_date_day'));
			$this->assertNull($Request->get('_date_month'));
			$this->assertNull($Request->get('_date_year'));
			$this->assertNull($Request->get('_date_hour'));
			$this->assertNull($Request->get('_date_minutes'));
			
			$_GET['_date_day'] 		= '22';
			$_GET['_date_month'] 	= '12';
			$_GET['_date_year'] 	= '2002';
			$_GET['_date_hour'] 	= '13';
			$_GET['_date_minutes'] 	= '25';
			$_GET['_date_seconds'] = '36';
			
			$Request = new Request();
			$this->assertEqual($Request->get('date'), '2002-12-22 13:25:36');
			$this->assertNull($Request->get('_date_day'));
			$this->assertNull($Request->get('_date_month'));
			$this->assertNull($Request->get('_date_year'));
			$this->assertNull($Request->get('_date_hour'));
			$this->assertNull($Request->get('_date_minutes'));
			$this->assertNull($Request->get('_date_seconds'));
			
			$_GET['_date_at_day'] 	= '20';
			$_GET['_date_at_month'] = '10';
			$_GET['_date_at_year'] 	= '2000';

			$Request = new Request();
			$this->assertEqual($Request->get('date_at'), '2000-10-20');
			$this->assertNull($Request->get('_date_at_day'));
			$this->assertNull($Request->get('_date_at_month'));
			$this->assertNull($Request->get('_date_at_year'));
		}
		
		public function tearDown() {
		}
	}