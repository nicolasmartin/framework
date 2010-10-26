<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfFormHelper extends UnitTestCase {
		public $Model;
		
		public function __construct() {
		    Config::set('code.xhtml', false);
		    
		    echo FormHelper::text('name', 'value', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::password('name', 'value', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::textarea('name', 'value', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::select('name', array('1' => 'un', '2' => 'deux'), '1', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::select('name', array('1' => 'un', '2' => 'deux'), array('1', '2'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::select('name', array('1' => 'un', '2' => 'deux'), array('1', '2'), array('empty' => '-- select --', 'class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::checkbox('name', 'value', null, array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::checkbox('name', 'value', 'value', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::checkboxes('name', '1', array('1' => 'un', '2' => 'deux'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::checkboxes('name', array('1', '2') , array('1' => 'un', '2' => 'deux'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::radio('name', 'value', null, array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::radio('name', 'value', 'value', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::radios('name', '1', array('1' => 'un', '2' => 'deux'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::radios('name', array('1', '2') , array('1' => 'un', '2' => 'deux'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::hidden('name', 'value', array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::date('name', null , range('2010', '2015'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::date('name', '2010-10-24 10:00:00' , range('2010', '2015'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::datetime('name', null , range('2010', '2015'), array('class' => 'myClass'));
		    echo '<br />';
		    echo FormHelper::datetime('name', null , range('2010', '2015'), array('class' => 'myClass', 'seconds' => true));
		    echo '<br />';
		}

		public function setUp() {
		  $this->Model = new FormHelperModel();  
		  $this->Model['name'] = 'obj';
		}
		
		public function testInputText() {
		    $this->assertEqual(
		        FormHelper::text('name', 'value', array('class' => 'myClass')),
		        '<input type="text" name="name" class="myClass" value="value" id="name">');

		    $this->assertEqual(
		        FormHelper::text('name', $this->Model, array('class' => 'myClass')),
		        '<input type="text" name="name" class="myClass" value="obj" id="name">');		        
		       
		}

		public function testInputPassword() {
		    $this->assertEqual(
		        FormHelper::password('name', 'value', array('class' => 'myClass')),
		        '<input type="password" name="name" class="myClass" value="value" id="name">');
		        
		    $this->assertEqual(
		        FormHelper::password('name', $this->Model, array('class' => 'myClass')),
		        '<input type="password" name="name" class="myClass" value="obj" id="name">');
		}

		public function testTextarea() {
		    $this->assertEqual(
		        FormHelper::textarea('name', 'value', array('class' => 'myClass')),
		        '<textarea name="name" class="myClass" id="name">value</textarea>');

		    $this->assertEqual(
		        FormHelper::textarea('name', $this->Model, array('class' => 'myClass')),
		        '<textarea name="name" class="myClass" id="name">obj</textarea>');
		}

		public function testSelect() {
		    $this->assertEqual(
		        FormHelper::select('name', array('1' => 'un', '2' => 'deux'), '1', array('class' => 'myClass')),
		        '<select name="name" class="myClass" id="name">'.
		        '<option value="1" selected="selected">un</option>'.
		        '<option value="2">deux</option>'.
		        '</select>');

		    $this->assertEqual(
		        FormHelper::select('name', array('1' => 'un', '2' => 'deux'), array('1', '2'), array('class' => 'myClass')),
		        '<select name="name" class="myClass" id="name">'.
		        '<option value="1" selected="selected">un</option>'.
		        '<option value="2" selected="selected">deux</option>'.
		        '</select>');
		        
		    $this->assertEqual(
		        FormHelper::select('name', array('1' => 'un', '2' => 'deux'), array('1', '2'), array('empty' => '-- select --', 'class' => 'myClass')),
		        '<select name="name" class="myClass" id="name">'.
		        '<option value="">-- select --</option>'.
		        '<option value="1" selected="selected">un</option>'.
		        '<option value="2" selected="selected">deux</option>'.
		        '</select>');

		    $this->assertEqual(
		        FormHelper::select('name', array('obj' => 'un', '2' => 'deux'), $this->Model, array('class' => 'myClass')),
		        '<select name="name" class="myClass" id="name">'.
		        '<option value="obj" selected="selected">un</option>'.
		        '<option value="2">deux</option>'.
		        '</select>');
		}
		
		public function testCheckbox() {
		    $this->assertEqual(
		        FormHelper::checkbox('name', 'value', null, array('class' => 'myClass')),
		        '<input type="checkbox" name="name" class="myClass" value="value">');		    

		    $this->assertEqual(
		        FormHelper::checkbox('name', 'value', 'value', array('class' => 'myClass')),
		        '<input type="checkbox" name="name" class="myClass" value="value" checked="checked">');		    

		    $this->assertEqual(
		        FormHelper::checkbox('name', $this->Model, 'obj', array('class' => 'myClass')),
		        '<input type="checkbox" name="name" class="myClass" value="obj" checked="checked">');		    
		}

		public function testCheckboxes() {
		    $this->assertEqual(
		        FormHelper::checkboxes('name', array('1' => 'un', '2' => 'deux'), '1', array('class' => 'myClass')),
		        '<input type="checkbox" name="name" class="myClass" value="1" checked="checked"> un '.
		        '<input type="checkbox" name="name" class="myClass" value="2"> deux ');

            $this->assertEqual(
                 FormHelper::checkboxes('name', array('1' => 'un', '2' => 'deux'), array('1', '2'), array('class' => 'myClass')),
                 '<input type="checkbox" name="name" class="myClass" value="1" checked="checked"> un '.
                 '<input type="checkbox" name="name" class="myClass" value="2" checked="checked"> deux ');
                 
 		    $this->assertEqual(
 		        FormHelper::checkboxes('name', array('obj' => 'un', '2' => 'deux'), $this->Model, array('class' => 'myClass')),
 		        '<input type="checkbox" name="name" class="myClass" value="obj" checked="checked"> un '.
 		        '<input type="checkbox" name="name" class="myClass" value="2"> deux ');
 		}
		
		public function testRadio() {
		    $this->assertEqual(
		        FormHelper::radio('name', 'value', null, array('class' => 'myClass')),
		        '<input type="radio" name="name" class="myClass" value="value">');		    

		    $this->assertEqual(
		        FormHelper::radio('name', 'value', 'value', array('class' => 'myClass')),
		        '<input type="radio" name="name" class="myClass" value="value" checked="checked">');		    

		    $this->assertEqual(
		        FormHelper::radio('name', $this->Model, 'obj', array('class' => 'myClass')),
		        '<input type="radio" name="name" class="myClass" value="obj" checked="checked">');
		}

		public function testRadios() {
		    $this->assertEqual(
		        FormHelper::radios('name', array('1' => 'un', '2' => 'deux'), '1', array('class' => 'myClass')),
		        '<input type="radio" name="name[]" class="myClass" value="1" checked="checked"> un '.
		        '<input type="radio" name="name[]" class="myClass" value="2"> deux ');

		    $this->assertEqual(
		        FormHelper::radios('name', array('1' => 'un', '2' => 'deux'), array('1', '2'), array('class' => 'myClass')),
		        '<input type="radio" name="name[]" class="myClass" value="1" checked="checked"> un '.
		        '<input type="radio" name="name[]" class="myClass" value="2" checked="checked"> deux ');
		        
 		    $this->assertEqual(
 		        FormHelper::radios('name', array('obj' => 'un', '2' => 'deux'), $this->Model, array('class' => 'myClass')),
 		        '<input type="radio" name="name[]" class="myClass" value="obj" checked="checked"> un '.
 		        '<input type="radio" name="name[]" class="myClass" value="2"> deux ');
		}
		
		public function testHidden() {
		    $this->assertEqual(
		        FormHelper::hidden('name', 'value', array('class' => 'myClass')),
		        '<input type="hidden" name="name" class="myClass" value="value" id="name">');
		        
		    $this->assertEqual(
		        FormHelper::hidden('name', $this->Model, array('class' => 'myClass')),
		        '<input type="hidden" name="name" class="myClass" value="obj" id="name">');		    
		}
		
		public function testDate() {
		    $this->assertEqual(
		        FormHelper::date('name', null , range('2010', '2015'), array('class' => 'myClass')),
		        '<select name="name_day" class="myClass" id="name_day">'.
		        '<option value="01">01</option>'.
		        '<option value="02">02</option>'.
		        '<option value="03">03</option>'.
		        '<option value="04">04</option>'.
		        '<option value="05">05</option>'.
		        '<option value="06">06</option>'.
		        '<option value="07">07</option>'.
		        '<option value="08">08</option>'.
		        '<option value="09">09</option>'.
		        '<option value="10">10</option>'.
		        '<option value="11">11</option>'.
		        '<option value="12">12</option>'.
		        '<option value="13">13</option>'.
		        '<option value="14">14</option>'.
		        '<option value="15">15</option>'.
		        '<option value="16">16</option>'.
		        '<option value="17">17</option>'.
		        '<option value="18">18</option>'.
		        '<option value="19">19</option>'.
		        '<option value="20">20</option>'.
		        '<option value="21">21</option>'.
		        '<option value="22">22</option>'.
		        '<option value="23">23</option>'.
		        '<option value="24">24</option>'.
		        '<option value="25">25</option>'.
		        '<option value="26">26</option>'.
		        '<option value="27">27</option>'.
		        '<option value="28">28</option>'.
		        '<option value="29">29</option>'.
		        '<option value="30">30</option>'.
		        '<option value="31">31</option>'.
		        '</select>'.
		        '<select name="name_month" class="myClass" id="name_month">'.
		        '<option value="01">janvier</option>'.
		        '<option value="02">février</option>'.
		        '<option value="03">mars</option>'.
		        '<option value="04">avril</option>'.
		        '<option value="05">mai</option>'.
		        '<option value="06">juin</option>'.
		        '<option value="07">juillet</option>'.
		        '<option value="08">août</option>'.
		        '<option value="09">septembre</option>'.
		        '<option value="10">octobre</option>'.
		        '<option value="11">novembre</option>'.
		        '<option value="12">décembre</option>'.
		        '</select>'.
		        '<select name="name_year" class="myClass" id="name_year">'.
		        '<option value="2010">2010</option>'.
		        '<option value="2011">2011</option>'.
		        '<option value="2012">2012</option>'.
		        '<option value="2013">2013</option>'.
		        '<option value="2014">2014</option>'.
		        '<option value="2015">2015</option>'.
		        '</select>');	    

		    $this->assertEqual(
		        FormHelper::date('name', '2010-10-24 10:00:00' , range('2010', '2015'), array('class' => 'myClass')),
		        '<select name="name_day" class="myClass" id="name_day">'.
		        '<option value="01">01</option>'.
		        '<option value="02">02</option>'.
		        '<option value="03">03</option>'.
		        '<option value="04">04</option>'.
		        '<option value="05">05</option>'.
		        '<option value="06">06</option>'.
		        '<option value="07">07</option>'.
		        '<option value="08">08</option>'.
		        '<option value="09">09</option>'.
		        '<option value="10">10</option>'.
		        '<option value="11">11</option>'.
		        '<option value="12">12</option>'.
		        '<option value="13">13</option>'.
		        '<option value="14">14</option>'.
		        '<option value="15">15</option>'.
		        '<option value="16">16</option>'.
		        '<option value="17">17</option>'.
		        '<option value="18">18</option>'.
		        '<option value="19">19</option>'.
		        '<option value="20">20</option>'.
		        '<option value="21">21</option>'.
		        '<option value="22">22</option>'.
		        '<option value="23">23</option>'.
		        '<option value="24" selected="selected">24</option>'.
		        '<option value="25">25</option>'.
		        '<option value="26">26</option>'.
		        '<option value="27">27</option>'.
		        '<option value="28">28</option>'.
		        '<option value="29">29</option>'.
		        '<option value="30">30</option>'.
		        '<option value="31">31</option>'.
		        '</select>'.
		        '<select name="name_month" class="myClass" id="name_month">'.
		        '<option value="01">janvier</option>'.
		        '<option value="02">février</option>'.
		        '<option value="03">mars</option>'.
		        '<option value="04">avril</option>'.
		        '<option value="05">mai</option>'.
		        '<option value="06">juin</option>'.
		        '<option value="07">juillet</option>'.
		        '<option value="08">août</option>'.
		        '<option value="09">septembre</option>'.
		        '<option value="10" selected="selected">octobre</option>'.
		        '<option value="11">novembre</option>'.
		        '<option value="12">décembre</option>'.
		        '</select>'.
		        '<select name="name_year" class="myClass" id="name_year">'.
		        '<option value="2010" selected="selected">2010</option>'.
		        '<option value="2011">2011</option>'.
		        '<option value="2012">2012</option>'.
		        '<option value="2013">2013</option>'.
		        '<option value="2014">2014</option>'.
		        '<option value="2015">2015</option>'.
		        '</select>');
		}

		public function testDatetime() {
		    $this->assertEqual(
		        FormHelper::datetime('name', null , range('2010', '2015'), array('class' => 'myClass')),
		        '<select name="name_day" class="myClass" id="name_day">'.
		        '<option value="01">01</option>'.
		        '<option value="02">02</option>'.
		        '<option value="03">03</option>'.
		        '<option value="04">04</option>'.
		        '<option value="05">05</option>'.
		        '<option value="06">06</option>'.
		        '<option value="07">07</option>'.
		        '<option value="08">08</option>'.
		        '<option value="09">09</option>'.
		        '<option value="10">10</option>'.
		        '<option value="11">11</option>'.
		        '<option value="12">12</option>'.
		        '<option value="13">13</option>'.
		        '<option value="14">14</option>'.
		        '<option value="15">15</option>'.
		        '<option value="16">16</option>'.
		        '<option value="17">17</option>'.
		        '<option value="18">18</option>'.
		        '<option value="19">19</option>'.
		        '<option value="20">20</option>'.
		        '<option value="21">21</option>'.
		        '<option value="22">22</option>'.
		        '<option value="23">23</option>'.
		        '<option value="24">24</option>'.
		        '<option value="25">25</option>'.
		        '<option value="26">26</option>'.
		        '<option value="27">27</option>'.
		        '<option value="28">28</option>'.
		        '<option value="29">29</option>'.
		        '<option value="30">30</option>'.
		        '<option value="31">31</option>'.
		        '</select>'.
		        '<select name="name_month" class="myClass" id="name_month">'.
		        '<option value="01">janvier</option>'.
		        '<option value="02">février</option>'.
		        '<option value="03">mars</option>'.
		        '<option value="04">avril</option>'.
		        '<option value="05">mai</option>'.
		        '<option value="06">juin</option>'.
		        '<option value="07">juillet</option>'.
		        '<option value="08">août</option>'.
		        '<option value="09">septembre</option>'.
		        '<option value="10">octobre</option>'.
		        '<option value="11">novembre</option>'.
		        '<option value="12">décembre</option>'.
		        '</select>'.
		        '<select name="name_year" class="myClass" id="name_year">'.
		        '<option value="2010">2010</option>'.
		        '<option value="2011">2011</option>'.
		        '<option value="2012">2012</option>'.
		        '<option value="2013">2013</option>'.
		        '<option value="2014">2014</option>'.
		        '<option value="2015">2015</option>'.
		        '</select> '.
		        '<input type="text" name="name_hours" size="3" maxlength="2" >'.
		        ' : '.
		        '<input type="text" name="name_minutes" size="3" maxlength="2" >'
       		 );	
       		 
		    $this->assertEqual(
		        FormHelper::datetime('name', null , range('2010', '2015'), array('class' => 'myClass', 'seconds' => true)),
		        '<select name="name_day" class="myClass" id="name_day">'.
		        '<option value="01">01</option>'.
		        '<option value="02">02</option>'.
		        '<option value="03">03</option>'.
		        '<option value="04">04</option>'.
		        '<option value="05">05</option>'.
		        '<option value="06">06</option>'.
		        '<option value="07">07</option>'.
		        '<option value="08">08</option>'.
		        '<option value="09">09</option>'.
		        '<option value="10">10</option>'.
		        '<option value="11">11</option>'.
		        '<option value="12">12</option>'.
		        '<option value="13">13</option>'.
		        '<option value="14">14</option>'.
		        '<option value="15">15</option>'.
		        '<option value="16">16</option>'.
		        '<option value="17">17</option>'.
		        '<option value="18">18</option>'.
		        '<option value="19">19</option>'.
		        '<option value="20">20</option>'.
		        '<option value="21">21</option>'.
		        '<option value="22">22</option>'.
		        '<option value="23">23</option>'.
		        '<option value="24">24</option>'.
		        '<option value="25">25</option>'.
		        '<option value="26">26</option>'.
		        '<option value="27">27</option>'.
		        '<option value="28">28</option>'.
		        '<option value="29">29</option>'.
		        '<option value="30">30</option>'.
		        '<option value="31">31</option>'.
		        '</select>'.
		        '<select name="name_month" class="myClass" id="name_month">'.
		        '<option value="01">janvier</option>'.
		        '<option value="02">février</option>'.
		        '<option value="03">mars</option>'.
		        '<option value="04">avril</option>'.
		        '<option value="05">mai</option>'.
		        '<option value="06">juin</option>'.
		        '<option value="07">juillet</option>'.
		        '<option value="08">août</option>'.
		        '<option value="09">septembre</option>'.
		        '<option value="10">octobre</option>'.
		        '<option value="11">novembre</option>'.
		        '<option value="12">décembre</option>'.
		        '</select>'.
		        '<select name="name_year" class="myClass" id="name_year">'.
		        '<option value="2010">2010</option>'.
		        '<option value="2011">2011</option>'.
		        '<option value="2012">2012</option>'.
		        '<option value="2013">2013</option>'.
		        '<option value="2014">2014</option>'.
		        '<option value="2015">2015</option>'.
		        '</select> '.
		        '<input type="text" name="name_hours" size="3" maxlength="2" >'.
		        ' : '.
		        '<input type="text" name="name_minutes" size="3" maxlength="2" >'.
		        ' : '.
		        '<input type="text" name="name_seconds" size="3" maxlength="2" >'
    		 );
		}		
		
		
		public function tearDown() {
		}
	}
	
	class FormHelperModel extends Doctrine_Record
    {
        public function setTableDefinition()
        {
            $this->hasColumn('name', 'string', 50);
        }
    }