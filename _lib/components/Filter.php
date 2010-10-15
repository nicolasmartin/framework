<?php
    class FilterComponent extends Component {
		static function email($email) {
			return filter_var($email, FILTER_SANITIZE_EMAIL);	
		}

		static function url($url) {
			$url = filter_var($url, FILTER_SANITIZE_URL);
			if (substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://') {
				return 'http://'.$url;	
			}
			return $url;		
		}

		static function path($path) {
			return filter_var($path, FILTER_SANITIZE_URL);		
		}

		static function int($int) {
			return filter_var($int, FILTER_SANITIZE_NUMBER_INT);		
		}

		static function float($float) {
			return filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT);		
		}

		static function regexp($string, $regexp) {
			return preg_replace($regexp, '', $string);
		}

		static function tags($string, $tags = array(), $notallowed = false) {
			if ($notallowed) {
				$tags = implode('|', $tags);
				return preg_replace('~</?('.$tags.').*?>~i', '', $string);
			}
			$tags = '<'.implode('><', $tags).'>';
			return strip_tags($string, $tags);
		}

		static function html($string) {
			return filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_AMP);		
		}

		static function sanitize($data, $inline_styles = false) {
			if (is_array($data)) {
				return sanitize_array($data, $inline_styles);	
			}
			return sanitize($data, $inline_styles);
		}
	}