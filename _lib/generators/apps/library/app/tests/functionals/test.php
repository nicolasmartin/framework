<?php
    class TestOfTest extends FunctionalWebTestCase {
    	public function setUp() {	
    	}
    	
        function testTest() {
            $this->assertTrue($this->get(DOMAIN));
        }
        
    	public function tearDown() {
    	}
    }
