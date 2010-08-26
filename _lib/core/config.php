<?php
	abstract class ConfigCore {
		protected static $property = array();

		public static function set($name, $value) {
			self::$property[$name] = $value;
		}

		public static function get($name = null) {
			if ($name) {
				return self::$property[$name];
			}
			return self::$property;
		}
	}