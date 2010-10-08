<?php
class TestOfDefault extends FunctionalWebTestCase {
    
    function testHomepage() {
        $this->assertTrue($this->get(DOMAIN));
    }
}
?>