<?php
    class ValidatorComponent extends Component {
		static function email($email) {
			return filter_var($email, FILTER_VALIDATE_EMAIL);	
		}
		
		static function url($url) {
			return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED);		
		}

		static function path($path) {
			return filter_var($url, FILTER_VALIDATE_URL);
		}
		
		static function bool($bool) {
			return filter_var($bool, FILTER_VALIDATE_BOOLEAN);		
		}	

		static function int($int, $min = 0, $max = null) {
			return filter_var($int, FILTER_VALIDATE_INT, array('options' => array('min_range' => $min, 'max_range' => $max)));		
		}

		static function length($string, $min, $max) {
			$len = mb_strlen($string);
			return ($len >= $min && $len <= $max);
		}

		static function float($float) {
			return filter_var($float, FILTER_VALIDATE_FLOAT);		
		}

		static function regexp($string, $regexp) {
			return filter_var($string, FILTER_VALIDATE_REGEXP, array("options"=> array("regexp"=>$regexp)));	
		}
    }