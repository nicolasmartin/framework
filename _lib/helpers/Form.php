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

	static function getHasErrorClass($field, $Model, $full = true) {
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			if ($full) {
				return 'class="has-error"';
			}
			return 'has-error';
		}
		return "";	
	}
		
	static function getErrorClass($field, $Model, $full = true) {
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			if ($full) {
				return 'class="error"';
			}
			return 'error';
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