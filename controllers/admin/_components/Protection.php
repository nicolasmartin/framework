<?php
	class ProtectionComponent extends Component {	
		public $Controller, $User, $options;
		
		public function __construct($Controller, $options = array()) {
			$default = array(
				'login' 			=> '/admin/users/login',
				'authorize'			=> array('login', 'logout'),
				'basic'				=> false
			);
			$this->options = array_merge($default, $options);
			$this->Controller = $Controller;
		}
		
		public function basic($username, $password) {
			$u = null;
			$p = null;
			if (isset($_SERVER['REMOTE_USER'])) {
				if (preg_match('/Basic\s+(.*)$/i', $_SERVER['REMOTE_USER'], $matches)) {
					$splits = explode(':', base64_decode($matches[1]));
					$u = $splits[0];
					$p = $splits[1];
				};
			} elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
					$u = $_SERVER['PHP_AUTH_USER'];
					$p = $_SERVER['PHP_AUTH_PW'];
			}
			if ($username != $u && $password != sha1($p)) {
				header('WWW-Authenticate: Basic realm="Forbidden"');
				header('HTTP/1.0 401 Unauthorized');
				return false;
			}
			return true;
		}
		
		public function preExecute() {
			if (is_array($this->options['basic'])) {
				$this->basic($this->options['basic']['username'], $this->options['basic']['password']);
			} else {
				session_start();
				$User = isset($_SESSION['_protection']) ? $_SESSION['_protection'] : null;
				session_write_close();
				if (!isset($User) && !in_array($this->Controller->action, $this->options['authorize'])) {
					FlashComponent::set('error', "Cette partie est privée, vous devez vous identifier.");
					$this->Controller->redirect($this->options['login'], 403);
				} else {
					$this->setUser($User);
					$this->Controller->View->set('Protection', $User);
				}
			}
		}
		
		public function setUser($User) {
			$this->User = $User;
		}
		
		public function getUser() {
			return $this->User;
		}
		
		public function login($User) {
			session_start();
			$_SESSION['_protection'] = $User;
			session_write_close();	
		}
				
		public function logout() {
			session_start();
			unset($_SESSION['_protection']);
			session_write_close();	
		}
	}