<?php
class FormHelper extends Helper {
	static function isChecked($posted, $value, $default = false) {
		if ($posted == null) {
			if ($default == true) {
				return 'checked="checked"';
			}
		} else {
			if ($posted == $value) {
				return 'checked="checked"';
			}
		}
		return '';
	}
	
	static function getErrorClass($field, $Model) {
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			return 'class="error"';
		}
		return "";	
	}
	
	static function displayErrors($field, $Model) {
		$html = "";
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			$html .= '<ul class="errors">';
			foreach($stack[$field] as $key) {
				if (isset($Model->messages[$field][$key])) {
					$html .= '<li>'.$Model->messages[$field][$key].'</li>';
				} else {
					$html .= '<li>Erreur inconnue : '.$key.'</li>';
				}
			}	
			$html .= '</ul>';
		}
		return $html;
	}
}
?>