<?php
	class Request {
		protected $rawPost, $rawGet, $rawRequest;
		protected $post, $get, $request;
		
		public static $instance;
								
		public function __construct() {
			$this->rawPost 		= isset($_POST) 	? $_POST 	: data();
			$this->rawGet 		= isset($_GET)  	? $_GET  	: data();
			$this->rawRequest 	= isset($_REQUEST) 	? $_REQUEST : data();

			$this->post 		= $this->process($this->rawPost);
			$this->get 			= $this->process($this->rawGet);
			$this->request 		= array_merge($this->get, $this->post);
		}
		
		public function post($key = null, $default = null) {
			if (!$key) {
				return $this->post;
			}
			if (isset($this->post[$key])) {
				return $this->post[$key];
			}
			return $default;
		}

		public function get($key = null, $default = null) {
			if (!$key) {
				return $this->get;
			}
			if (isset($this->get[$key])) {
				return $this->get[$key];
			}
			return $default;
		}
		
		public function request($key = null, $default = null) {
			if (!$key) {
				return $this->request;
			}
			if (isset($this->request[$key])) {
				return $this->request[$key];
			}
			return $default;
		}

		public function rawPost($key = null, $default = null) {
			if (!$key) {
				return $this->rawPost;
			}
			if (isset($this->rawPost[$key])) {
				return $this->rawPost[$key];
			}
			return $default;
		}

		public function rawGet($key = null, $default = null) {
			if (!$key) {
				return $this->rawGet;
			}
			if (isset($this->rawGet[$key])) {
				return $this->rawGet[$key];
			}
			return $default;
		}
		
		public function rawRequest($key = null, $default = null) {
			if (!$key) {
				return $this->rawRequest;
			}
			if (isset($this->rawRequest[$key])) {
				return $this->rawRequest[$key];
			}
			return $default;
		}
		
		public function method() {
			return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;
		}
		
		public function isPost() {
			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
				return true;	
			}
			return false;
		}
		
		public function isGet() {
			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
				return true;	
			}
			return false;
		}
			
		public function isAjax() {
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") { 
				return true;
			}
			return false;
		}

		public static function getInstance($url = null) {
			if (!isset(self::$instance)) {
				self::$instance = new self($url);
			}
			return self::$instance;
		}
		
		private function process($data) {
			$data = FilterComponent::sanitize($data);
			$data = $this->smartDates($data);
			return $data;
		}
		
		private function smartDates($data) {
			foreach($data as $key => $value) {
				if (preg_match('/_(.*?)_/', $key, $match)) {
					$field  	= $match[1];
					$prefix 	= '_'.$match[1].'_';
					$time 		= null;
					$date 		= null;		
					$year 		= isset($data[$prefix.'year']) 		? $data[$prefix.'year'] 	: null;
					$month 		= isset($data[$prefix.'month']) 	? $data[$prefix.'month'] 	: null;
					$day 		= isset($data[$prefix.'day']) 		? $data[$prefix.'day'] 		: null;
					$hour 		= isset($data[$prefix.'hour']) 		? $data[$prefix.'hour'] 	: null;
					$minutes 	= isset($data[$prefix.'minutes']) 	? $data[$prefix.'minutes'] 	: null;
					$seconds 	= isset($data[$prefix.'seconds']) 	? $data[$prefix.'seconds'] 	: '00';	
									
					if ($year && $month && $day) {
						$date = sprintf('%02d-%02d-%02d',
							$year,
							$month,
							$day
						);
						unset($data[$prefix.'year']);
						unset($data[$prefix.'month']);
						unset($data[$prefix.'day']);
					}

					if ($hour && $minutes) {
						$time = sprintf('%02d:%02d:%02d',
							$hour,
							$minutes,
							$seconds
						);
						unset($data[$prefix.'hour']);
						unset($data[$prefix.'minutes']);
						unset($data[$prefix.'seconds']);
					}

					if ($date && $time) {
						$data[$field] = $date.' '.$time;
					} else if ($date) {
						$data[$field] = $date;
					} else if ($time) {
						$data[$field] = $time;
					}
				}
			}
			return $data;	
		}
	}