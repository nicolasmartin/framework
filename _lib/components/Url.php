<?php
	class UrlComponent extends Component {
		static function path($path = null, $id = null) {		
			$Dispatcher = Dispatcher::getInstance();
			$default = array(
				'app' 			=> null,
				'controller' 	=> null,
				'action' 		=> null,
				'params' 		=> null,
			);
			
			if ($path == '/') {
				return '/';
			}

			if (!$path) {
				$path = '/'.$Dispatcher->getUrl();
			}
			
			if (!is_array($path)) {
				if ($path{0} !== '/') {
					$path = '/'.$Dispatcher->getApp().'/'.$path;
				}				
				$path = preg_replace('~(^/|/$)~', '', $path);
				$splits = explode('/', $path);
				$path = array();
				
				$path['app'] 			= @$splits[0];
				$path['controller'] 	= @$splits[1];
				$path['action'] 		= @$splits[2];
				$path['params'] 		= @implode('/', array_slice($splits, 3));
			}

			if (empty($path['params']) && $id) {
				$path['params'] = array($id);
			}

			$path = array_merge($default, $path);
			if ($path['controller'] && $path['params']) {
				if (!$path['action']) {
					$path['action'] = 'index';
				}
			}
			if ($path['app'] && $path['params']) {
				if (!$path['controller']) {
					$path['controller'] = 'default';
				}
				if (!$path['action']) {
					$path['action'] = 'index';
				}
			}
			if ($path['params'] && !$path['action']) {
				$path['action'] 	= $Dispatcher->getActionName();
			}
			if ($path['action'] && !$path['controller']) {
				$path['controller'] = $Dispatcher->getControllerName();
			}
			if ($path['controller'] && !$path['app']) {
				$path['app'] 		= $Dispatcher->getApp();
			}
			if (!$path['app'] && !$path['controller'] && !$path['action'] && !$path['params']) {
				$path['app'] 		= $Dispatcher->getApp();
				$path['controller'] = $Dispatcher->getControllerName();
				$path['action']		= $Dispatcher->getActionName();
			}
			if (is_array($path['params'])) {
				$params = array();
				foreach($path['params'] as $key => $value) {
					if (is_int($key)) {
						$params[] = $value;
					} else {
						$params[] = $key.'/'.$value;
					}
				}
				$path['params'] = implode('/', $params);
			}
			
			if ($path['app'] == 'default') {
				unset($path['app']);
			} else {
				$path['app'] = __($path['app'], null, null, 'url');
			}
			$path['controller'] = __($path['controller'], null, null, 'url');
			$path['action'] 	= __($path['action'], null, null, 'url');

			$new_path = implode($path, '/');
			$new_path = '/'.$new_path;
			$new_path = preg_replace('~/{2,}~', '/', $new_path);
			$new_path = preg_replace('~/$~', '', $new_path);

			if (!$new_path) {
				return '/';
			}

			return $new_path;
		}

		private static function isApp($app) {
			if (is_dir(ROOT.'apps/'.$app)) {
				return true;
			}
			return false;
		}

		private static function isController($app, $controller) {
			if (file_exists(ROOT.'apps/'.$app.'/'.ucfirst($controller).'.php')) {
				return true;
			}
			return false;
		}

		static function blackList($blacklist = array()) {
			$params = Dispatcher::getInstance()->getParams();
			foreach($params as $key => $value) {
				if (in_array($key, 	$blacklist)) {
					unset($params[$key]);
				}
			}
			return self::path(array('params' => $params));
		}
		
		static function whiteList($whitelist = array()) {
			if (!$whitelist) {
				return self::path(array('params' => array()));
			}
			$params = Dispatcher::getInstance()->getParams();
			foreach($params as $key => $value) {
				if (!in_array($key, $whitelist)) {
					unset($params[$key]);
				}
			}
			return self::path(array('params' => $params));
		}

		static function url($path = null) {
			$path = self::path($path);
			$url = $_SERVER['SERVER_NAME'].$path;
			if (isset($_SERVER['HTTPS'])) {
				return 'https://'.$url;
			}
			return 'http://'.$url;
		}

	}
    