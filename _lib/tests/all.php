<?php
require_once(dirname(__FILE__) . '/../vendors/simpletest/autorun.php');

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All tests');
        $this->addFile(dirname(__FILE__) . '/test.php');
		$this->addFile(dirname(__FILE__) . '/filters.php');
		
    }
}
?>