<?php
	class Dispatcher {
		protected $app, $controller, $action;
		protected $params = array();
		protected $rawParams = array();
		protected $get;	
		protected $post;	
		protected $method;	
		protected $url;	
		
		public static $instance;
								
		public function __construct($url) {
			$this->setUrl($url);
		}

		public static function getInstance($url = null) {
			if (!isset(self::$instance)) {
				self::$instance = new self($url);
			}
			return self::$instance;
		}

		public function setUrl($url) {
			$this->url 	= $url;	
			$parsed		= $this->parseUrl($this->url);

			$this->url 			= $parsed['url'];
			$this->app 			= $parsed['app'];
			$this->controller 	= $parsed['controller'];
			$this->action 		= $parsed['action'];
			$this->params 		= $parsed['params'];
			$this->rawParams 	= $parsed['rawParams'];
		}

		public function getUrl() {
			return $this->url;	
		}

		public function setApp($app) {
			$this->app = $app;
		}

		public function getApp() {
			return $this->app;	
		}

		public function setControllerName($controller) {
			$this->controller = $controller;
		}
		
		public function getControllerName() {
			return $this->controller;	
		}

		public function setActionName($action) {
			$this->action = $action;
		}
		
		public function getActionName() {
			return $this->action;	
		}
		
		public function setParams($params) {
			$this->params = $params;
		}
		
		public function getParams() {
			return $this->params;	
		}

		public function setRawParams($params) {
			$this->params = $params;
		}
		
		public function getRawParams() {
			return $this->rawParams;
		}
	
		public function parseUrl($url) {
			$where 		= preg_replace('~(/index.php|^/)~', '', $_SERVER['SCRIPT_NAME']);
			
			$splits 	= explode('/', $url);
			$app 		= !empty($where) 	 ? __($where, null, true, 'url') : 'default';
			$controller = !empty($splits[0]) ? __($splits[0], null, true, 'url') : 'default';
			$action		= !empty($splits[1]) ? __($splits[1], null, true, 'url') : 'index';
			$params 	= !empty($splits[2]) ? array_slice($splits, 2) : array();

			$clean = array();
			for($i = 0; $i < count($params); $i=$i+2) {
				if (isset($params[$i+1])) {
					$clean[$params[$i]] = $params[$i+1];
				}
			}

			return array(
				'url' 			=> $app.'/'.$url,
				'app' 			=> $app,
				'controller' 	=> $controller,
				'action' 		=> $action,
				'params' 		=> $clean,
				'rawParams' 	=> $params
			);
		}
		
		public function dispatch() {		
			$class	= InflectionComponent::camelCase($this->controller).'Controller';
			$action	= InflectionComponent::camelCase($this->action, false);

			if (!class_exists($class)) {
				throw new Except("Le Controlleur '".$class."' n'existe pas", 404);
			}
			
			if (!method_exists($class, $action)) {
				throw new Except("L'Action '".$action."' n'existe pas dans ".$class, 404);
			}

			$get	= Request::getInstance()->get();
			$post	= Request::getInstance()->post();

			$Controller = new $class($action);
			$Controller->app = $this->app;
				
			foreach($this->params as $key => $value) {
				$Controller->setParam($key, $value);
			}
			foreach($get as $key => $value) {
				$Controller->setParam($key, $value);
			}
			foreach($post as $key => $value) {
				$Controller->setParam($key, $value);
			}
			$Controller->preExecute();	
				
			call_user_func_array(array($Controller, $action), $this->rawParams);
			
			$Controller->postExecute();
			$Controller->spit();
		}
	}
