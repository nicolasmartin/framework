<?php
	class UrlComponent extends ComponentCore {
		static function url($path) {
			$url = $_SERVER['SERVER_NAME'].selfUrlComponent::path($path);;
			if (isset($_SERVER['HTTPS'])) {
				return 'https://'.$url;
			}
			return 'http://'.$url;
		}
	
		static function www($path) {
			$url = $_SERVER['SERVER_NAME'].$path;
			if (isset($_SERVER['HTTPS'])) {
				return 'https://'.$url;
			}
			return 'http://'.$url;
		}

		static function path($path = null) {		
			$offset 	= 0;
			$Dispatcher = Dispatcher::getInstance();
			$default 	= array(
				'app' 			=> null,
				'lang' 			=> null,
				'controller' 	=> null,
				'action' 		=> null,
				'params' 		=> null,
			);

			if (!$path) {
				$path = $Dispatcher->getUrl();
			}
			
			if (defined('LANG') && LANG) {
				$lang = LANG;	
			} else {
				$lang = null;	
			}
			
			if (!is_array($path)) {
				$path 	= preg_replace('~^/|/$~', '', $path);
				$splits = explode('/', $path);
	
				$url['lang'] = $lang;
				for($i = 0; $i <= 1; $i++) {
					if (self::isLang(@$splits[$i], $splits[0])) {
						$url['lang'] = $splits[$i];
						unset($splits[$i]);
						$offset++;
						break;
					}
				}
	
				if (self::isApp($splits[0])) {
					$url['app'] = @$splits[0];
				} else {
					$offset--;
					$url['app'] = null;	
				}
				$url['controller'] 	= @$splits[1+$offset];
				$url['action'] 		= @$splits[2+$offset];
				$url['params'] 		= @implode('/', array_slice($splits, 3+$offset));
			} else {
				$url = array_merge($default, $path);
			}
	
			if (is_array($url['params'])) {
				$params = array();
				foreach($url['params'] as $key => $value) {
					$params[] = $key.'/'.$value;
				}
				$url['params'] = implode('/', $params);
			}
	
			if ($url['params'] && !$url['action']) {
				$url['action'] = $Dispatcher->getActionName();
			}
	
			if ($url['action'] && !$url['controller']) {
				$url['controller'] = $Dispatcher->getControllerName();
			}
	
			$splits = array();
			$splits[0] = ($url['app']) 			? $url['app'] 			: $Dispatcher->getApp();
			$splits[1] = ($url['lang']) 		? $url['lang'] 			: $lang;
			$splits[2] = ($url['controller'])	? $url['controller'] 	: null;
			$splits[3] = ($url['action']) 		? $url['action'] 		: null;
			$splits[4] = ($url['params']) 		? $url['params'] 		: null;	
			
			$splits[0] = __($splits[0], null, null, 'url');
			$splits[1] = __($splits[1], null, null, 'url');
			$splits[2] = __($splits[2], null, null, 'url');
			$splits[3] = __($splits[3], null, null, 'url');
			
			$url = implode($splits, '/');
			$url = '/'.$url.'/';
			$url = preg_replace('~/{2,}~', '/', $url);
	
			return $url;
		}
		
		private static function isApp($name) {
			if (file_exists(ROOT.'www/'.$name.'/.htaccess')) {
				return true;
			}
			return false;
		}
	
		private static function isLang($lang, $app = null) {
			foreach(I18n::getDefinitionPath() as $path) {
				if (file_exists($path.$lang.'.php')) {
					return true;
				}
			}
			return false;
		}
	}
    