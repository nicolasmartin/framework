<?php
class TestOfMobile extends FunctionalWebTestCase {
    
    function testHomepage() {
        $this->assertTrue($this->get(DOMAIN.'/mobile'));
    }
}
?>