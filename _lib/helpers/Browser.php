<?php
class BrowserHelper extends Helper {
	static function getClass($full = false) {
		$class = array();
		
		if (BrowserComponent::Firefox()) {
			$class[] = 'firefox';	
		}
		if (BrowserComponent::Safari()) {
			$class[] = 'safari';	
		}
		if (BrowserComponent::Opera()) {
			$class[] = 'opera';	
		}
		if (BrowserComponent::Chrome()) {
			$class[] = 'chrome';	
		}
		if (BrowserComponent::IE()) {
			$class[] = 'ie';	
		}
		if (BrowserComponent::IE6()) {
			$class[] = 'ie6';	
		}
		if (BrowserComponent::IE7()) {
			$class[] = 'ie7';	
		}
		if (BrowserComponent::IE8()) {
			$class[] = 'ie8';	
		}
		if (BrowserComponent::IE9()) {
			$class[] = 'ie9';	
		}
		if (BrowserComponent::Idevice()) {
			$class[] = 'Idevice';	
		}
		if (BrowserComponent::Ipad()) {
			$class[] = 'ipad';	
		}
		if (BrowserComponent::Iphone()) {
			$class[] = 'iphone';	
		}
		if (BrowserComponent::Mobile()) {
			$class[] = 'mobile';	
		}
		
		$class = implode(' ', $class);
		
		if ($full && $class) {
			return sprintf('class="%s"', $class);
		}
		
		return $class;
	}
} 
