<?php
class GeneratorHelper extends Helper {
	static function getPath($app = null, $controller = null) {
		if ($app && $controller) {
			return '/'.strtolower($app).'/'.strtolower($controller);
		} elseif ($app && !$controller) {
			return '/'.strtolower($app);
		} elseif (!$app && $controller) {
			return '/'.strtolower($controller);
		} else {
			return '/';	
		}
	}
	
	static function field($field, $mapping) {
		if (isset($mapping[$field])) {
			return $mapping[$field];
		};
		return InflectionComponent::humanize($field);
	}
	
	static function formElement($model, $field) {
		$Table = Doctrine::getTable($model);
		$def = $Table->getColumnDefinition($field);
		
		pr($def);
	}
} 
