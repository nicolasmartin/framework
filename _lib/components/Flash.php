<?php
	class FlashComponent extends Component {
		static function set($type, $message) {
			session_start();
			$_SESSION['_flash'] = array($type => $message);
			session_write_close();
		}

		static function has($type = null) {
			$flash = false;
			session_start();
			if (isset($_SESSION['_flash'][$type])) {
				$flash = true;
			}
			if (!$type && isset($_SESSION['_flash'])) {
				$flash = true;
			}
			session_write_close();
		
			return $flash;
		}

		static function get($type = null) {
			$flash = array();		
			session_start();
			if (isset($_SESSION['_flash'][$type])) {
				$flash = $_SESSION['_flash'][$type];
				unset($_SESSION['_flash'][$type]);
			}
			if (!$type && isset($_SESSION['_flash'])) {
				$flash = $_SESSION['_flash'];
				unset($_SESSION['_flash']);
			}
			session_write_close();
		
			return $flash;
		}
	}