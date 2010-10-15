<?php
	class Config {
		protected static $property = array();

		public static function set($name, $value) {
			self::$property[$name] = $value;
		}

		public static function get($name = null, $default = null) {
			if ($name) {
			    if (isset(self::$property[$name])) {
				    return self::$property[$name];
			    } else {
			        return $default;
			    }
			}
			return self::$property;
		}
	}