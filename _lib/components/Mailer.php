<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'../_lib/vendors/phpmailer/class.phpmailer.php');

    class MailerComponent extends PHPMailerLite {
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
		
		public function setTo($email, $name = null) {
			parent::addAddress($email, $name);
		}
		
		public function addAddress($email, $name = null) {
			parent::addAddress($email, $name);
		}
		
		public function setFrom($email, $name = null) {
			parent::setFrom($email, $name);
		}
		
		public function send() {
			arent::send();	
		}
	}