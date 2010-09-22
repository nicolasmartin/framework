<?php
	abstract class ControllerCore implements ControllerCoreInterface {
		public $View;
		public $app;
		public $name;
		public $action;
		public $method;
		public $post = array();
		public $get = array();

		protected $layout 		= 'default';
		protected $params 		= array();
		protected $Components 	= array();
		
		public function __construct($action = null, $params = array()) {
			$this->name 	= str_replace('controller', '', strtolower(get_class($this)));	
			$this->action 	= $action;
			$this->params	= $params;

			$this->Layout	= new Layout($this->layout);	
			$this->Layout->setController($this);
			
			$this->View 	= new View($this->name.'/'.$this->action, $this->Layout);	
			$this->View->setController($this);
			$this->View->setAutoRender(true);
		}
		
		public function addComponent($name, $options = array()) {
			$class = InflectionComponent::camelCase($name).'Component';
			$this->Components[$name] = new $class($this, $options);
		}
		
		private function doCallback($callback) {
			foreach($this->Components as $Component) {
				$Component->$callback();
			}
		}
		
		public function preRender() {
			$this->doCallback('preRender');
		}

		public function postRender() {
			$this->doCallback('postRender');
		}
		
		public function preExecute() {
			$this->doCallback('preExecute');
		}

		public function postExecute() {
			$this->doCallback('postExecute');
		}
		
		public function setParam($name, $value = null) {
			if (is_array($name)) {
				if (is_array($value)) {
					$name = array_merge($name, $value);	
				}
				foreach($name as $key => $value) {
					$this->params[$key] = $value;
				}
			} else {
				$this->params[$name] = $value;	
			}
		}

		public function getComponents() {
			return $this->Components;
		}

		public function getComponent($name) {
			if (isset($this->Components[$name])) {
				return $this->Components[$name];
			}
			return null;
		}
		
		public function getView() {
			return $this->View;
		}
		
		public function getName() {
			return $this->name;
		}

		public function getAction() {
			return $this->action;
		}
		
		public function getApp() {
			return $this->app;
		}

		public function getMethod() {
			return $this->method;	
		}

		public function getPost($name, $default = null) {
			if (isset($this->post[$name])) {
				return $this->post[$name];
			}
			return $default;
		}
		
		public function getGet($name, $default = null) {
			if (isset($this->get[$name])) {
				return $this->get[$name];
			}
			return $default;
		}
		
		public function getParam($name, $default = null) {
			if (isset($this->params[$name])) {
				return $this->params[$name];
			}
			return $default;
		}

		public function setParams($array = array()) {
			$this->params = $array;
		}

		public function getParams() {
			return $this->params;
		}
		
		public function redirect($path = null, $code = null) {
			switch($code) {
				case 301:
					$message = '301 Moved Permanently';
				break;
				case 404:
					$message = '404 Not Found';
					$altpath = '/pages/page404/';
				break;
				case 403:
					$message = '403 Forbidden';
					$altpath = '/pages/page403/';
				break;
				case 500:
					$message = '500 Internal Server Error';
					$altpath = '/pages/page500/';
				break;	
				case 503:
					$message = '503 Service Unavailable';
					$altpath = '/pages/page503/';	
				break;
			}
			
			$this->View->setAutorender(false);
			
			if (isset($message)) {
//				header($_SERVER['SERVER_PROTOCOL'].' '.$message);
//				header('Status: '.$message);
			}

			if (isset($altpath) && !$path) {
				$path = $altpath;
			}
			
			header('location:'.UrlComponent::path($path)); 
			exit;
		}
		
		public function isAjax() {
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") { 
				return true;
			}
			return false;
		}

		public function spit() {
			if ($this->View->getAutoRender()) {
				$this->doCallback('preRender');
				if ($this->View->getPath()) {
					$this->View->spit();
				}
				$this->doCallback('postRender');
			}
		}
	}
	
	interface ControllerCoreInterface {		
		public function preExecute();
		
		public function postExecute();
		
		public function preRender();
		
		public function postRender();
	}
