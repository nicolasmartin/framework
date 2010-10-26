<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfGeneratorHelper extends UnitTestCase {
		
		public function __construct() {
		}

		public function setUp() {	
		}

		public function testFormElement() {
            $columns = Doctrine::getTable('generatorHelperModel')->getColumns();

            foreach($columns as $name => $column) {
                
                echo "<div>";
                echo "<label>".$name."</label><br />";
                echo GeneratorHelper::getFormElement($name, 'generatorHelperModel', 1);
                echo "</div>";
                
            }
		}

		public function tearDown() {
		}
	}
	
    class generatorHelperModel extends Doctrine_Record
    {
        public function setTableDefinition()
        {
            $this->hasColumn('name', 'string', 50, array(
            'notnull' => true,
            ));
            $this->hasColumn('password', 'string', 50, array(
            'notnull' => true,
            ));
            $this->hasColumn('description', 'string', 255, array(
            ));
            $this->hasColumn('date', 'date');
            $this->hasColumn('datetime', 'timestamp');
            $this->hasColumn('digit1', 'int', 1, array(
            ));
            $this->hasColumn('digit2', 'int', 2, array(
            ));
            $this->hasColumn('digit3', 'int', 3, array(
            ));
            $this->hasColumn('digit4', 'int', 4, array(
            ));
            $this->hasColumn('digit5', 'int', 5, array(
            ));
            $this->hasColumn('body', 'cblob');
            $this->hasColumn('body2', 'blob', 255);
            $this->hasColumn('status', 'bool');
            $this->hasColumn('enum1', 'enum', null,
                      array('values' => array('un', 'deux', 'trois'))
                  );
        }
    }