<?php
class UrlHelper extends UrlComponent {
	static function mailto($email, $mailto = 'mailto:') {
		$encoded_email = '';
		$len = strlen($email);
		for ($i = 0; $i < $len; $i++) {
			$byte = strtoupper(dechex(ord($email{$i})));
			$byte = str_repeat('0', 2 - strlen($byte)).$byte;
			$encoded_email .= '%'.$byte.'';
		}

		$encoded = '';
		$email = $mailto.$encoded_email;
		$len = strlen($email);
		for ($i = 0; $i < $len; $i++) {
			$encoded .= '&#'.ord($email{$i}).';';
		}
		
		return $encoded;
	}
	
	static function isHomepage() {
		$Dispatcher = Dispatcher::getInstance();
		$Bootstrap 	= Bootstrap::getInstance();
		
		if ($Dispatcher->getControllerName().'/'.$Dispatcher->getActionName() == $Bootstrap->getDefaultPath()) {
			return true;	
		} else if ($Dispatcher->getControllerName().'/'.$Dispatcher->getActionName() == 'default/index') {
			return true;
		}
		return false;
	}
}
