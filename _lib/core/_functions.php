<?php
    function is_cli() {
        return (php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']));
    }
    
	function diff($old, $new){
		$maxlen = 0;
		foreach($old as $oindex => $ovalue){
			$nkeys = array_keys($new, $ovalue);
			foreach($nkeys as $nindex){
				$matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
				$matrix[$oindex - 1][$nindex - 1] + 1 : 1;
				if($matrix[$oindex][$nindex] > $maxlen){
					$maxlen = $matrix[$oindex][$nindex];
					$omax = $oindex + 1 - $maxlen;
					$nmax = $nindex + 1 - $maxlen;
				}
			}
		}
		if($maxlen == 0) return array(array('d' => $old, 'i' => $new));
		return array_merge(
			diff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
			array_slice($new, $nmax, $maxlen),
			diff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen))
		);
	}

	function htmlDiff($old, $new, $format = array('+' => '<ins>%s</ins>', '-' => '<del>%s</del>')) {
		$diff = diff(str_split($old), str_split($new));
		$ret = '';
		foreach($diff as $k) {
			if(is_array($k)) {
				$ret .= (!empty($k['d']) ? sprintf($format['-'], implode('', $k['d'])) : '').(!empty($k['i']) ? sprintf($format['+'], implode('',$k['i'])) : '');
			} else { 
				$ret .= $k . '';
			}
		}
		return $ret;
	}
	
	function contains($pattern, $string) {
		$s = $e = '\b';
		if (substr($pattern, 0, 1) == '*') {
			$pattern = preg_replace('~^[*]~', '', $pattern);
			$s = '';
		}
		if (substr($pattern, -1) == '*') {
			$pattern = preg_replace('~[*]$~', '', $pattern);			
			$e = '';
		}
		$pattern = preg_replace('~[*]~', '.*', $pattern);		
		return preg_match('~'.$s.$pattern.$e.'~', $string);	;
	}
	
	function cFirst($string) {
		$string = utf8_decode($string);
		$string = strtolower($string);
		$first  = strtr($string{0}, 
			utf8_decode('äâàáåãéèëêòóôõöøìíîïùúûüýñçþÿæœðø'), 
			utf8_decode('ÄÂÀÁÅÃÉÈËÊÒÓÔÕÖØÌÍÎÏÙÚÛÜÝÑÇÞÝÆŒÐØ')
		);
		$string = ucfirst($first).substr($string, 1);
		return utf8_encode($string);
	}

	function app() {
		$app = preg_replace('~(/index.php|^/)~', '', $_SERVER['SCRIPT_NAME']);
		return $app ? $app : 'default';
	}

	function base() {
		return '/'.app();
	}

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

	function strcut($string, $len, $end = '...') {
		if (strlen($string) <= $len) {
			return $string;
		}
		$str = substr($string, 0, $len);
		$splits = explode(' ', $str);
		$chars = strlen($splits[count($splits)-1]);
		return substr($str, 0, ($chars+1)*-1).$end;
	}

	function exception_handler($e) {
		$message  = "<div style='padding:20px; font:12px/1.7 Arial'>";
		$message .= "<h1>[".$e->getCode()."] ".$e->getMessage()."</h1>";

		$message .= '<ul style="margin-bottom:50px">';
		$message .= '<li><b>Fichier :</b> '.basename($e->getFile()).' [ <span style="color:red">'.$e->getLine().'</span> ]</li>';
		$message .= '<li><b>Chemin :</b> <a href="'.$e->getFile().'">'.$e->getFile().'</a></li>';
		$message .= '</ul>';
		
		$trace = $e->getTrace();
		$trace = array_reverse($trace);
		
		$message .= "<h2>Trace :</h2>";
		foreach ($trace as $t) {
			$message .= '<ul style="margin-bottom:30px">';
			if (!isset($t['file'])) {
			    $t['file'] = $e->getFile();
			    $t['line'] = $e->getLine();
			}
		  $message .= '<li><b>Fichier :</b> '.basename($t['file']).' [ ligne <span style="color:red">'.$t['line'].'</span> ]</li>';
		  $message .= '<li><b>Chemin :</b> <a href="'.$t['file'].'">'.$t['file'].'</a></li>';
			if (isset($t['class']) && !empty($t['class'])) {
				$message .= '<li><b>Classe :</b> '.$t['class'].$t['type'].$t['function'].'('.strcut(implode_r(', ', $t['args']), 5000, '<b style="color:red">[ ... ]</b>').')</li>';
			} else if (isset($t['function']) && !empty($t['function'])) {
				$message .= '<li><b>Fonction :</b> '.$t['function'].'('.strcut(implode_r(', ', $t['args']), 5000, '<b style="color:red">[ ... ]</b>').')</li>';
			}
			if (isset($t['args']) && !empty($t['args'])) {
				$message .= '<li><b>Arguments :</b> <ul><li>'.strcut(implode_r(', ', $t['args']), 5000, '<b style="color:red">[ ... ]</b>').'</li></ul></li>';
			}
			$message .= '</ul>';
		}
		$message .= "</div>";
		die($message);
	}
	set_exception_handler('exception_handler'); 

	function implode_r($glue, $array, $format = '(%s)'){
		$out = '';
		foreach ($array as $item) {
			if (is_array($item)) {
				$out .= sprintf($format, implode_r($glue, $item));
			} else {
				if ($out) {
					$out .= $glue;
				}
				$out .= print_r($item, true);
			}
		}
		return $out;
	 }
	 
	 function explode_with_keys($seperator, $string) {
			 $output = array();
			 $array = explode($seperator, $string);
			 foreach ($array as $value) {
					 $row = explode("=", $value);
					 $output[$row[0]] = $row[1];
			 }
			 return $output;
	 }

	function protection($username, $password) {
		if (!isset($_SERVER['PHP_AUTH_USER'])
		|| ($username != $_SERVER['PHP_AUTH_USER'] || $password != sha1($_SERVER['PHP_AUTH_PW']))) {
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
			pr($string);
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
    
    function array_remove($array, $values) {
        foreach((array) $values as $value) {
            unset($array[array_search($value, (array) $array)]);
        }
        return $array;
    }

    function array_extend($array1, $array2) {
        foreach($array2 as $key => $value) {
            if( is_array($value) ) {
                if( !isset($array1[$key]) ) {
                    $array1[$key] = $value;
                } else {
                    $array1[$key] = array_extend($array1[$key], $value);
                }
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
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

	function duplicate_filename($path, $filename) {
		if (file_exists(str_replace('//', '/', $path.'/'.$filename))) {
			return duplicate_filename($path, inc_filename($filename));
		}
		return $filename;
	}

	function inc_filename($filename) {
		preg_match('~(.*?)(\((\d*)\))?(\..*?)$~', $filename, $match);
		$inc = '.';
		if ($match[3]) {
			$inc = '('.($match[3]+1).')';
		} else if (!$match[3]) {
			$inc = '(1)';
		}
		$f = $match[1].$inc.$match[4];
		return $f;		
	}

    function read_folder($path, $content = array()) {
    	if ($handle = opendir($path)) {
    		while (false !== ($item = readdir($handle))) {
    			if ($item != '.' && $item != '..') {
    				if (is_dir($path.'/'.$item)) {
    					$content = array_merge($content, read_folder($path.'/'.$item));
    				} else {
    					$content[] = preg_replace('~^(\./)?(.*?)/~', '', $path.'/'.$item);
    				}
    			}
    		}
    		closedir($handle);
		}
    	return $content;
    }

    function delete_folder($path) {
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
	
	function create_folder($path) {
		@mkdir($path);	
	}