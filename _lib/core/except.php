<?php
	abstract class ExceptCore extends Exception {
		public function __construct($message, $code = 0, Exception $previous = null) {
			if (ini_get('display_errors') == 1) {
				return parent::__construct($message, $code, $previous);
			}
			switch ($code) {
				case 404:
					header('location:'.UrlComponent::path('/pages/page404/'));
				break;
				case 403:
					header('location:'.UrlComponent::path('/pages/page403/'));		
				break;
				default:
					header('location:'.UrlComponent::path('/pages/page500/'));
			}
			exit;
		}
	}