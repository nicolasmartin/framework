<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	require_once(dirname(__FILE__).'/../vendors/simpletest/autorun.php');

	class TestOfFilters extends UnitTestCase {
		public function setUp() {
			
		}
		
		public function testSanitize() {
			$string = '<b>one</b> <a href="javascript:alert(xss)" target="_blank" style="style">two</a> <em class="test" onclick="xss">three</em> four <script>javascript</script><style>style</style><link rel="stylesheet" type="text/css" />';
			$ok		= '<b>one</b> <a target="_blank">two</a> <em class="test">three</em> four ';
			$clean = Filter::sanitize($string);
		
			$this->assertEqual($clean, $ok);
		
			$string = '<b>one</b> <a href="javascript: alert(xss)" target="_blank" style=\'style\'>two</a> <em class="test" onclick = "xss">three</em> four <script>javascript</script><style>style</style><link rel="stylesheet" type="text/css" />';
			$ok		= '<b>one</b> <a target="_blank">two</a> <em class="test">three</em> four ';
			$clean = Filter::sanitize($string);
		
			$this->assertEqual($clean, $ok);	
		
			$array = array(
				'one' => '<b>bold</bold>',
				'two' => array(
					'one' => '<script type="text/javascript">alert("xss")</script>',
					'two' => '<a href="javascript:alert(\'xss\')" target="_blank">link</a>',
					'three' => '<body style="display:none">xss</body>'
				),
				'three' => '<span style="display:none">test</span>'
			);
			$ok = array(
				'one' => '<b>bold</bold>',
				'two' => array(
					'one' => '',
					'two' => '<a target="_blank">link</a>',
					'three' => '<body>xss</body>'
				),
				'three' => '<span>test</span>'
			);
			$clean = Filter::sanitize($array);
		
			$this->assertEqual($clean, $ok);
		}
		
		function testEmail() {
			$email = "test@test.com";
			$this->assertTrue(Validate::email($email));
			
			$email = "t est@test.com";
			$this->assertFalse(Validate::email($email));
			
			$email = Filter::email($email);
			$this->assertTrue(Validate::email($email));
		}

		function testUrl() {
			$url = "http://url.com";
			$this->assertTrue(Validate::url($url));

			$url = "http:/url.com";
			$this->assertFalse(Validate::url($url));

			$url = "http://u rl.com";
			$this->assertFalse(Validate::url($url));

			$url = Filter::url($url);
			$this->assertTrue(Validate::url($url));
			
			$url = "url.com";
			$this->assertEqual(Filter::url($url), 'http://url.com');
		}

		function testString() {
			$string = "abcedf";
			$this->assertFalse(Validate::length($string, 1, 5));

			$string = "abcd";
			$this->assertTrue(Validate::length($string, 1, 5));
		}
	
		function testRegexp() {
			$string = "abcedf";
			$this->assertTrue(Validate::regexp($string, '/[a-z]/'));
			
			$string = "abcedf";
			$this->assertFalse(Validate::regexp($string, '/[1-9]/'));
			
			$string = "abc123edf";
			$this->assertEqual(Filter::regexp($string, '/[1-9]/'), 'abcedf');
		}


		function testTags() {
			$string = "<b>a</b><em>b</em>c<img />";
			$this->assertEqual(Filter::tags($string), 'abc');


			$this->assertEqual(Filter::tags($string, array('b')), '<b>a</b>bc');
			$this->assertEqual(Filter::tags($string, array('b', 'em',  'img')), '<b>a</b><em>b</em>c<img />');
			
			//echo Filter::tags($string, array('b', 'em'), true);
			
			$this->assertEqual(Filter::tags($string, array('b'), true), 'a<em>b</em>c<img />');
			$this->assertEqual(Filter::tags($string, array('img'), true), '<b>a</b><em>b</em>c');
			$this->assertEqual(Filter::tags($string, array('b', 'img'), true), 'a<em>b</em>c');
		}
		
		public function tearDown() {
			
		}		
	}