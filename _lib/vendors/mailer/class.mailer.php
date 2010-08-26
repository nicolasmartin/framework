<?php
	include dirname(__FILE__).'/class.phpmailer.php';

	class Mailer extends PHPMailerLite {
		public function setBody($body = null) {
			$this->Body = $body;	
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