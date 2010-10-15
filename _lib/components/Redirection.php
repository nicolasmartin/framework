<?php
	class RedirectionComponent extends Component {	
		public $Controller, $options;
		
		public function __construct($Controller, $options = array()) {
			$default = array(
					array(
						'bool' => null,
						'path' => null
					)
			);
			$this->options = array_merge($default, $options);
			$this->Controller = $Controller;
		}
		
		public function preExecute() {
			foreach($this->options as $condition) {
				if ($condition['bool'] && $condition['path']) {
					$this->Controller->redirect($condition['path']);
				}
			}
		}
		
		static public function cancel($key) {
			session_start();
			$_SESSION['_redirection'] = array($key => 'cancelled');
			session_write_close();
		}

		
		static public function isCancelled($key) {
			session_start();
			$cancelled = isset($_SESSION['_redirection'][$key]);
			session_write_close();
			return $cancelled;
		}
	}