<?php
	require_once(dirname(__FILE__).'/_bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfFuncContains extends UnitTestCase {
	
		public function __construct() {
		}

		public function setUp() {	
		}

		public function testContains() {
			$test = 'début milieu fin';
			
			$this->assertTrue(contains('début*', 			$test));
			$this->assertTrue(contains('début', 			$test));
			$this->assertTrue(contains('*début', 			$test));
			$this->assertTrue(contains('*début*', 			$test));

			$this->assertTrue(contains('milieu*', 			$test));
			$this->assertTrue(contains('milieu', 	 		$test));
			$this->assertTrue(contains('*milieu', 			$test));
			$this->assertTrue(contains('*milieu*', 			$test));

			$this->assertTrue(contains('fin*', 				$test));
			$this->assertTrue(contains('fin', 		 		$test));
			$this->assertTrue(contains('*fin', 		 		$test));
			$this->assertTrue(contains('*fin*', 			$test));

			$this->assertTrue(contains('mi*eu', 			$test));
			$this->assertTrue(contains('dé*in', 			$test));
			
			$this->assertTrue(contains('début milieu fin', 	$test));
			$this->assertTrue(contains('début milieu', 		$test));
			$this->assertTrue(contains('milieu fin',		$test));
		}

		public function testNotContains() {
			$test = 'début milieu fin';
			
			$this->assertFalse(contains('*ébu', 			$test));
			$this->assertFalse(contains('ébu', 				$test));
			$this->assertFalse(contains('ébu*', 			$test));
			
			$this->assertFalse(contains('*ili', 			$test));
			$this->assertFalse(contains('ili', 				$test));
			$this->assertFalse(contains('ili*', 			$test));

			$this->assertFalse(contains('ébut milieu fi', 	$test));
			$this->assertFalse(contains('mi*eZ', 			$test));
		}
		
		public function testReelLife() {
			$test = 'created_at';
			
			$this->assertTrue(contains('created_at', 		$test));
			
			$this->assertTrue(contains('*_at', 				$test));
			$this->assertTrue(contains('*_at*', 			$test));

			$this->assertFalse(contains('_at*', 			$test));
			$this->assertFalse(contains('_at', 				$test));
			
			$this->assertTrue(contains('*created*', 		$test));
			$this->assertTrue(contains('created*', 			$test));
			$this->assertFalse(contains('created', 			$test));

			$this->assertTrue(contains('*_at', 				$test.' date'));
			$this->assertFalse(contains('_at', 				$test.'_date'));
		}
		
		public function tearDown() {	
		}
	}