<?php
class TestOfDoctrine extends FunctionalWebTestCase {
    
    function testHomepage() {
		$this->assertTrue($this->get(DOMAIN.'/doctrine'));

		$this->assertAuthentication();
		$this->assertResponse('401');
	
		$this->authenticate(SU_USERNAME, SU_PASSWORD);

		$this->assertNoAuthentication();
		$this->assertTitle('Scripts Doctrine');
		$this->assertText('Doctrine');
    }
}
?>