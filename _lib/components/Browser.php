<?php
	class BrowserComponent extends Component {
		static function get($regexp) { 
			if (!isset($_SERVER['HTTP_USER_AGENT'])) {
				return false;	
			}
			preg_match($regexp, $_SERVER['HTTP_USER_AGENT'], $match); 
			return isset($match[1]) ? $match[1] : null; 
		} 
		
		static function is($string) { 
			if (!isset($_SERVER['HTTP_USER_AGENT'])) {
				return false;	
			}
			return (bool) stripos($_SERVER['HTTP_USER_AGENT'], $string); 
		} 
		
		static function Firefox() { 
			return self::get('~Firefox/([0-9\.]+)~'); 
		} 
		
		static function IE() { 
			return self::get('~MSIE ([0-9\.]+)~'); 
		} 
		
		static function IE6() { 
			return self::get('~MSIE (6.[0-9\.]+)~'); 
		} 
		
		static function IE7() { 
			return self::get('~MSIE (7.[0-9\.]+)~'); 
		} 
		
		static function IE8() { 
			return self::get('~MSIE (8.[0-9\.]+)~'); 
		} 
		
		static function IE9() { 
			return self::get('~MSIE (9.[0-9\.]+)~'); 
		} 
		
		static function Safari() { 
			return self::get('~Version/([0-9\.]+) Safari~'); 
		} 
		
		static function Chrome() { 
			return self::get('~Chrome/([0-9\.]+)~'); 
		} 
		
		static function Opera() { 
			return self::get('~Opera.*Version/([0-9\.]+)~'); 
		} 
		
		static function Windows() { 
			return self::is('Windows'); 
		}  
		 
		static function MacOs() { 
			return self::is('Macintosh'); 
		} 
		 
		static function Linux() { 
			return self::is('Linux'); 
		} 
		
		static function Gecko() { 
			return self::is('Gecko') ^ self::is('AppleWebKit'); 
		}
		
		static function Webkit() { 
			return self::is('AppleWebKit'); 
		}
		
		static function Android() { 
			return self::is('Android'); 
		}
		
		 
		static function Iphone() { 
			return self::is('iPhone') || self::is('iPod'); 
		}
		
		static function Ipad() { 
			return self::is('iPad'); 
		}
		
		static function Ipod() { 
			return self::is('iPod'); 
		}
		
		static function Idevice() { 
			return self::Iphone() || self::Ipad() || self::Ipod(); 
		}
		
		static function Mobile() { 
			return self::Iphone() || self::Ipod() || self::Android(); 
		}	
	}