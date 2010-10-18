<?php
class UrlHelper extends UrlComponent {
	static function mailto($email, $mailto = 'mailto:') {
		$encoded_email = '';
		$len = strlen($email);
		for ($i = 0; $i < $len; $i++) {
			$byte = strtoupper(dechex(ord($email{$i})));
			$byte = str_repeat('0', 2 - strlen($byte)).$byte;
			$encoded_email .= '%'.$byte.'';
		}

		$encoded = '';
		$email = $mailto.$encoded_email;
		$len = strlen($email);
		for ($i = 0; $i < $len; $i++) {
			$encoded .= '&#'.ord($email{$i}).';';
		}
		
		return $encoded;
	}
	
	static function isHomepage() {
		$Dispatcher = Dispatcher::getInstance();
		$Bootstrap 	= Bootstrap::getInstance();
		
		if ($Dispatcher->getControllerName().'/'.$Dispatcher->getActionName() == $Bootstrap->getDefaultPath()) {
			return true;	
		} else if ($Dispatcher->getControllerName().'/'.$Dispatcher->getActionName() == 'default/index') {
			return true;
		}
		return false;
	}
	
	static function getCurrentClass($check, $full = true) {
		$current = false;
		$Dispatcher = Dispatcher::getInstance();
		$default = array(
			'controller' 	=> null,
			'action'		=> null,
		);
		$check = array_merge($default, $check);
		
		if ($check['controller'] == $Dispatcher->getControllerName()) {
			$current = true;
			if ($check['action'] && $check['action'] != $Dispatcher->getActionName()) {
				$current = false;
			}
		}

		if ($current) {
			if ($full) {
				return ' class="current"';	
			} else {
				return 'current';	
			}
		}
		return '';
	}
	
	static function orderBy($field, $label) {
	    $Dispatcher = Dispatcher::getInstance();
	    $params     = $Dispatcher->getParams();
	    $orderby    = $field;
	    $dir        = 'asc';
	    $reverse    = 'desc';
	    $class      = '';
	    
	    $filter     = Config::get('pagination.filter');
	    $path       = UrlComponent::whitelist(array_remove($filter, array('orderby', 'dir')));

	    if (isset($params['orderby']) && $params['orderby'] == $field) {
	        $orderby = $params['orderby'];
	        if (isset($params['dir']) && $params['dir'] == 'asc') {
	            $class = 'class="order-asc"';
	            $reverse = 'desc';
	        } else {
	            $class = 'class="order-desc"';
	            $reverse = 'asc';
	        }
        }
        return '<a href="'.$path.'/orderby/'.$orderby.'/dir/'.$reverse.'" '.$class.'>'.$label.'</a>';
	}
}

