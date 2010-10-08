<?php
	require_once(dirname(__FILE__).'/bootstrap.php');
	
	define('DOMAIN', 		'http://pix.localhost');
	define('USER_AGENT', 	'Functional test');
	define('SU_USERNAME', 	'test');
	define('SU_PASSWORD', 	'f10unctional');
	
	//  Documentation : http://www.simpletest.org/en/web_tester_documentation.html
	//	assertTitle($title)				Pass if title is an exact match
	//	assertText($text)				Pass if matches visible and "alt" text
	//	assertNoText($text)				Pass if doesn't match visible and "alt" text
	//	assertPattern($pattern)			A Perl pattern match against the page content
	//	assertNoPattern($pattern)		A Perl pattern match to not find content
	//	assertLink($label)				Pass if a link with this text is present
	//	assertNoLink($label)			Pass if no link with this text is present
	//	assertLinkById($id)				Pass if a link with this id attribute is present
	//	assertNoLinkById($id)			Pass if no link with this id attribute is present
	//	assertField($name, $value)		Pass if an input tag with this name has this value
	//	assertFieldById($id, $value)	Pass if an input tag with this id has this value
	//	assertResponse($codes)			Pass if HTTP response matches this list
	//	assertMime($types)				Pass if MIME type is in this list
	//	assertAuthentication($protocol)	Pass if the current challenge is this protocol
	//	assertNoAuthentication()		Pass if there is no current challenge
	//	assertRealm($name)				Pass if the current challenge realm matches
	//	assertHeader($header, $content)	Pass if a header was fetched matching this value
	//	assertNoHeader($header)			Pass if a header was not fetched
	//	assertCookie($name, $value)		Pass if there is currently a matching cookie
	//	assertNoCookie($name)			Pass if there is currently no cookie of this name

	class FunctionalWebTestCase extends WebTestCase {
		function setUp() {
			$this->addHeader("User-Agent:".USER_AGENT);
			parent::setUp();
		}
	}

	class AllTests extends TestSuite {
		function AllTests() {
			$this->TestSuite('All tests');
			$this->addFile(dirname(__FILE__).'/default.php');
			$this->addFile(dirname(__FILE__).'/admin.php');
			$this->addFile(dirname(__FILE__).'/doctrine.php');
			$this->addFile(dirname(__FILE__).'/mobile.php');
		}
	}

	