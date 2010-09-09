<?php
	abstract class HelperCore {
		static function attributes($attributes) {
			$html = array();
			foreach($attributes as $key => $value) {
				$html[] = $key.'="'.$value.'"';
			}
			return implode(' ', $html);
		}

		static function attribute($name, $value) {
			if (isset($value)) {
				return $name.' = "'.addslashes($value).'"';	
			}
			return '';
		}
		
		static function xhtml() {
			return Config::get('code.xhtml') ? ' /' : '';
		}
	}