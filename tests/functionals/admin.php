<?php
class TestOfAdmin extends FunctionalWebTestCase {
	
    function testHomepage() {
        $this->assertTrue($this->get(DOMAIN.'/admin/'));
		$this->assertField('username');
		$this->assertField('password');

        $this->assertTrue($this->post(DOMAIN.'/admin/users/login/', array('username' => 'test', 'password' => 'f10unctional')));
		$this->assertTitle(new PatternExpectation('/Liste/'));
    }
}
