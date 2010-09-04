<?php
	include dirname(__FILE__).'/../vendors/phpmailer/class.phpmailer.php';

	class MailerCore extends PHPMailerLite {
		public function __construct() {
			$this->CharSet = 'utf-8';
			parent::__construct();	
		}
		
		public function setBody($body = null) {
			$this->Body = $body;	
		}
		
		public function setCharset($charset) {
			$this->Charset = $charset();	
		}
		
		public function setSubject($subject = null) {
			$this->Subject = $subject;	
		}
		
		public function setPriority($priority = null) {
			$this->Priority = $priority;	
		}
		
		public function setAltBody($body = null) {
			$this->AltBody = $body;
		}
	}