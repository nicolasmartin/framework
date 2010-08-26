<?php
require_once(dirname(__FILE__) . '/../vendors/simpletest/autorun.php');

class TestOfTest extends UnitTestCase {
	public function setUp() {
		
	}
	
	public function testTest() {
		$this->assertTrue(true);						// Fail if $x is false
		$this->assertFalse(false);						// Fail if $x is true
		$this->assertNull(null);						// Fail if $x is set
		$this->assertNotNull(true);						// Fail if $x not set
		$this->assertIsA($this, 'UnitTestCase');		// Fail if $x is not the class or type $t
		$this->assertNotA($this, 'NotUnitTestCase');	// Fail if $x is of the class or type $t
		$this->assertEqual(true, 1);					// Fail if $x == $y is false
		$this->assertNotEqual(false, 1);				// Fail if $x == $y is true
		$this->assertWithinMargin(10, 5, 5);			// Fail if abs($x - $y) < $m is false
		$this->assertOutsideMargin(10, 5, 4);			// Fail if abs($x - $y) < $m is true
		$this->assertIdentical(true, true);				// Fail if $x == $y is false or a type mismatch
		$this->assertNotIdentical(true, 1);				// Fail if $x == $y is true and types match
		$this->assertReference($this, $that = $this);	// Fail unless $x and $y are the same variable
		$this->assertClone($this, clone $this);			// Fail unless $x and $y are identical copies
		$this->assertPattern('/te.t/i', 'TeSt');		// Fail unless the regex $p matches $x
		$this->assertNoPattern('/te.t/i', 'ToSt');		// Fail if the regex $p matches $x
		$this->expectError('error');					// Swallows any upcoming matching error
		trigger_error('error');
	}
	
	public function tearDown() {
		
	}		
}
?>