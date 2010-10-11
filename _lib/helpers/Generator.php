<?php
class GeneratorHelper extends Helper {
	static function getPath($app, $controller) {
		if ($app) {
			return '/'.strtolower($app).'/'.strtolower($controller);
		} else {
			return '/'.strtolower($controller);
		}
	}
	
	static function getArticle($human) {
		
	}
} 
