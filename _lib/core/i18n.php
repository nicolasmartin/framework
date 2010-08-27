<?php
	abstract class I18nCore {
		public static $culture 		= null;
		public static $path 		= array();
		public static $definitions 	= array();
		
		static function setCulture($culture) {
			self::$culture = $culture;
		}
		
		static function getCulture() {
			return self::$culture;	
		}
		
		static function addDefinitionPath($path) {
			self::$path[] = $path;	
		}
		
		static function getDefinitionPath() {
			return self::$path;
		}
		
		static function addDefinition($key, $string) {
			self::$definitions = array_merge(self::$definitions, array($key => $string));
		}
		
		static function addDefinitions($array) {
			self::$definitions = array_merge(self::$definitions, $array);
		}
		
		static function loadDefinition($path, $lang = null) {
			if (!$lang && !self::$culture) {
				throw new Exception("La culture doit être configuré avant l'appel de cette méthode.");	
			}
			
			$file = $path.self::$culture.'.php';
			if (file_exists($file)) {
				include $file;
				self::$definitions = array_merge(self::$definitions, $i18n);
			} else {
				throw new Exception("Aucun fichier de langue '".$file."' n'est disponible.");
			}
		}		
		
		static function loadDefinitions() {
			if (!self::$culture) {
				throw new Exception("La culture doit être configuré avant l'appel de cette méthode.");	
			}
			
			if (empty(self::$path)) {
				throw new Exception("Des chemins de définitions doivent être configurés avant l'appel de cette méthode.");	
			}
			
			$found = false;
			foreach(self::$path as $path) {
				$file = $path.self::$culture.'.php';
				if (file_exists($file)) {
					include $file;
					self::$definitions = array_merge(self::$definitions, $i18n);
					unset($i18n);
					$found = true;
				}
			}
	
			if (!$found) {
				throw new Exception("Aucun fichier de langue '".$file."' n'est disponible.");	
			}
		}
		
		static function getDefinitions() {
			return self::$definitions;
		}
		
		static function translate($key, $params = array(), $reversed = null, $prefix = null) {
			$definitions = I18n::getDefinitions();
			$string = $key;
		
			if ($reversed) {
				if (is_array($params)) {
					foreach ($params as $k => $v) {
						$key = str_replace($v, '%%'.$k.'%%', $string);
					}
				}
				if ($string = array_search($key, $definitions)) {
					return preg_replace('~^'.$prefix.'\.~', '', $string);
				}
				return $key;
			}

			if (isset($definitions[$prefix.'.'.$key])) {
				$string = $definitions[$prefix.'.'.$key];
			} else if (isset($definitions[$key])) {
				$string = $definitions[$key];
			} else {
				$string = $key;
			}
			
			if (is_array($params)) {
				foreach ($params as $k => $v) {
					$string = str_replace('%%'.$k.'%%', $v, $string);
				}
			}

			return $string;	
		}
		
		static function detectLanguage($accept = array(), $default = 'fr') {
			$languages = explode(',', @$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			foreach($languages as $language) {
				$lang = substr($language, 0, 2);
				if ($accept && in_array($lang, $accept)) {
					return $lang;
				}
				return $default;
			}	
		}
	}