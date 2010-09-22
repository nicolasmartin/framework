<?php
	class DispatcherCore {
		protected 	$app;
		protected 	$controller;
		protected 	$action;
		protected 	$params;
		protected 	$get;	
		protected 	$post;	
		protected 	$method;	
		
		public static $instance;
								
		public function __construct($url) {
			$splits = explode('/', $url);

			$this->app 			= preg_replace('~(/index.php|^/)~', '', $_SERVER['SCRIPT_NAME']);	
			$this->controller 	= !empty($splits[0]) ? __($splits[0], null, true, 'url') : 'default';		
			$this->action 		= !empty($splits[1]) ? __($splits[1], null, true, 'url') : 'index';
			$this->params 		= !empty($splits[2]) ? array_slice($splits, 2) 	: array();	
		}

		public static function getInstance($url = null) {
			if (!isset(self::$instance)) {
				self::$instance = new self($url);
			}
			return self::$instance;
		}

		public function getApp() {
			return $this->app;	
		}

		public function getControllerName() {
			return $this->controller;	
		}

		public function getActionName() {
			return $this->action;	
		}
			
		public function getParams() {
			return $this->params;	
		}

		public function setApp($app) {
			$this->app = $app;
		}

		public function setControllerName($controller) {
			$this->controller = $controller;
		}

		public function setActionName($action) {
			$this->action = $action;
		}
			
		public function setParams($params) {
			$this->params = $params;
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

			$method = strtolower($_SERVER['REQUEST_METHOD']);
			$get	= isset($_GET)  ? FilterComponent::sanitize($_GET) : array();
			$post	= isset($_POST) ? FilterComponent::sanitize($_POST) : array();

			$Controller = new $class($action);
			$Controller->app 		= $this->app;
			$Controller->method 	= $method;
			$Controller->get 		= $get;
			$Controller->post 		= $post;
			
			for($i = 0; $i < count($this->params); $i=$i+2) {
				if (isset($this->params[$i+1])) {
					$Controller->setParam($this->params[$i], $this->params[$i+1]);
				}
				
				if (isset($get) && !empty($get)) {		
					foreach($get as $key => $value) {
						$Controller->setParam($key, $value);
					}
				}
				if (isset($post) && !empty($post)) {		
					foreach($post as $key => $value) {
						$Controller->setParam($key, $value);
					}
				}
			}
			$Controller->preExecute();		
			call_user_func_array(array($Controller, $action), $this->params);
			$Controller->postExecute();
			$Controller->spit();
		}
	}
