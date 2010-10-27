<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');
	
	class TestOfValidatorComponent extends UnitTestCase {
		public function setUp() {
		}
		
		function testEmail() {
			$email = "test@test.com";
			$this->assertTrue(ValidatorComponent::email($email));
			
			$email = "t est@test.com";
			$this->assertFalse(ValidatorComponent::email($email));
			
			$email = FilterComponent::email($email);
			$this->assertTrue(ValidatorComponent::email($email));
		}

		function testUrl() {
			$url = "http://url.com";
			$this->assertTrue(ValidatorComponent::url($url));

			$url = "http:/url.com";
			$this->assertFalse(ValidatorComponent::url($url));

			$url = "http://u rl.com";
			$this->assertFalse(ValidatorComponent::url($url));

			$url = FilterComponent::url($url);
			$this->assertTrue(ValidatorComponent::url($url));
		}

		function testString() {
			$string = "abcedf";
			$this->assertFalse(ValidatorComponent::length($string, 1, 5));

			$string = "abcd";
			$this->assertTrue(ValidatorComponent::length($string, 1, 5));
		}
	
		function testRegexp() {
			$string = "abcedf";
			$this->assertTrue(ValidatorComponent::regexp($string, '/[a-z]/'));
			
			$string = "abcedf";
			$this->assertFalse(ValidatorComponent::regexp($string, '/[1-9]/'));
		}
		
		public function tearDown() {
			
		}		
	}