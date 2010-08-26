<?php
	function __($key, $params = array(), $reversed = null, $prefix = null) {
		return I18N::translate($key, $params, $reversed, $prefix);
	}

	function sanitize($data, $inline_styles = false) {
		$patterns = array(
			'~<script[^>]*?>.*?</script>~si',
			'~<style[^>]*?>.*?</style>~si',
			'~<link[^>]*?>~si',
		);
		$data = preg_replace($patterns, '', $data);			
		$data = preg_replace("/[a-z]+=\s?(['\"])\s?(javascript\s?:|:\s?exp|:\s?expression).*?\\1\s?/i", "", $data);
		$data = preg_replace("/<(.*)?\son.+?=?\s?.+?(['\"]).*?\\2\s?(.*?)>/i", "<$1$3>", $data);
		if (!$inline_styles) {
			$data = preg_replace("/<(.*)?\sstyle\s?.+?(['\"]).*?\\2\s?(.*?)>/i", "<$1$5>", $data);
		}
		return $data;
	}
	
	function sanitize_array($array, $inline_styles = false) {
		foreach($array as $key => $value) {
			if (is_array($value)) {
				$array[$key] = sanitize_array($value, $inline_styles);	
			} else {
				$array[$key] = sanitize($value, $inline_styles);	
			}
		}
		return $array;
	}

	function protection($username, $password) {
		if (!isset($_SERVER['PHP_AUTH_USER'])
		|| ($username != $_SERVER['PHP_AUTH_USER'] && $password != sha1($_SERVER['PHP_AUTH_PW']))) {
			header('WWW-Authenticate: Basic realm="Forbidden"');
			header('HTTP/1.0 401 Unauthorized');
			return false;
		}
		return true;
	}
	
	function serial(array $array, $options) {
		$default = array(
			'begin' 			=> '',
			'end'				=> '"',
			'betweenKeyValue' 	=> '="',
			'betweenPair' 		=> '"&',
		);
		$options = array_merge($default, $options);
		
		$string = array();
		foreach($array as $key => $value) {
			$string[] = $key.$options['betweenKeyValue'].$value;
		}
		
		return $options['begin'].implode($options['betweenPair'], $string).$options['end'];
	}
	
	function d($string) {
		echo '<span style="color:red">'.$string.'</span>', "<br />";	
	}
	
	function e($string, $default = null) {
		if ($string === null) {
			$string = $default;
		}
		echo htmlspecialchars($string);
	}
	
	function i($condition, $then, $else) {
		if ($condition) {
			e($then);
		} else {
			e($else);
		}
	}

	function debug($string, $force = false) {
		if ((defined('DEBUG') && DEBUG) || $force) {
			echo '<pre style="background:#FFF; position:relative; z-index:10000; color:red; padding:5px;">';
			print_r($string);
			echo '</div>';
		}			
	}
		
	function pr($array) {	
		echo '<pre style="background:#FFF; position:relative; z-index:10000; color:red; padding:5px;">';
		print_r($array);
		echo "</pre>";
	}
	
	function vd($array) {	
		echo '<pre style="background:#FFF; position:relative; z-index:10000; color:red; padding:5px;">';
		var_dump($array);
		echo "</pre>";
	}

	function pluralize($n = 1, $string, $values = array()) {
		$string = str_replace("{#}", $n, $string);
		preg_match_all("/\{(.*?)\}/", $string, $matches);
		foreach($matches[1] as $k=>$v) {
			$part = explode("|", $v);
			if ($n === 0) {
				$mod = (count($part) == 1) ? "" : $part[0];
			} else if ($n === 1) {
				$mod = (count($part) == 1) ? "" : ((count($part) == 2) ? $part[0] : $part[1]);	
			} else {
				$mod = (count($part) == 1) ? $part[0] : ((count($part) == 2) ? $part[1] : $part[2]);	
			}
			$string = str_replace($matches[0][$k], $mod , $string);
		}
		return vsprintf($string, $values);
	}

	function clean_id_prefix($array) {
		$array_clean = array();
		foreach($array as $k => $v) {
			if ($v) {
				$array_clean[$k] = preg_replace('/[^\d]/', '', $v);
			}
		}
		return $array_clean;
	}

	function clean_filename($filename) {
		$filename = strtolower($filename);
		$filename = strtr($filename, 	'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
										'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
		$find	 	= array( '"' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,'' ,';' ,"'" ,',' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,' ' ,'---' ,'--','--');
		$replace 	= array('' ,'-' ,'-' ,'' ,'' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-' ,'-','-');
		$filename 	= str_replace($find, $replace, $filename);
		return $filename;
	}
	
	function make_filename($filename, $keep_original = 0) {
		if ($keep_original) {
			return uniqid().'-'.clean_filename($filename);
		}
		$part = pathinfo($filename);
		if (isset($part['extension'])) {
			return uniqid().'.'.$part['extension'];
		} else {
			return uniqid();
		}
	}

    function readFolder($path, $relative = false) {
		static $content = array();
		
    	if ($handle = opendir($path)) {
    		while (false !== ($item = readdir($handle))) {
    			if ($item != '.' && $item != '..') {
    				if (is_dir($path.'/'.$item)) {
    					readFolder($path.'/'.$item);
    				} else {
    					$content[] = $path.'/'.$item;
    				}
    			}
    		}
    		closedir($handle);
		}
		if ($relative) {
			foreach($content as $key => $value) {
				$content[$key] = preg_replace('~^'.$path.'/~', '', $value);
			}			
		}
    	return $content;
    }
	
    function deleteFolder($path) {
    	if ($handle = opendir($path)) {
    		while (false !== ($item = readdir($handle))) {
    			if ($item != '.' && $item != '..') {
    				if (is_dir($path.'/'.$item)) {
    					deleteFolder($path.'/'.$item);
    				} else {
    					@unlink($path.'/'.$item);
    				}
    			}
    		}
    		closedir($handle);
    		rmdir($path);
    	}
    }
	
	function createFolder($path) {
		@mkdir($path);	
	}