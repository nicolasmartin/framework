<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfRequest extends UnitTestCase {
		public function __construct() {
			
		}

		public function setUp() {	
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
			$_GET['_date_secosnds'] = '36';
			
			$Request = new Request();
			$this->assertEqual($Request->get('date'), '2002-12-22 13:25:36');
			$this->assertNull($Request->get('_date_day'));
			$this->assertNull($Request->get('_date_month'));
			$this->assertNull($Request->get('_date_year'));
			$this->assertNull($Request->get('_date_hour'));
			$this->assertNull($Request->get('_date_minutes'));
			$this->assertNull($Request->get('_date_seconds'));
		}
		
		public function tearDown() {
		}
	}