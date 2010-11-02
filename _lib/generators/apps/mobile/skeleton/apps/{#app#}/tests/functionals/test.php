<?php
    class TestOfHomepage extends FunctionalWebTestCase {
    	public function setUp() {	
    	}
    	
        function testHomepage() {
            $this->assertTrue($this->get(DOMAIN));
        }
        
    	public function tearDown() {
    	}
    }
