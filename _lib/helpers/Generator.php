<?php
class GeneratorHelper extends Helper {
    
    static function getFormElement($name, $model) {
        $columns = Doctrine::getTable($model)->getColumns();
        
        $default = array(
            'type'      => null,
            'notblank'  => null,
            'length'    => null,
        );
        
        $groups = array(
            'string'    => 'string',
            'char'      => 'string',
            'varchar'   => 'string',
            'blob'      => 'text',
            'cblob'     => 'text',
            'int'       => 'digit',
            'integer'   => 'digit',
            'float'     => 'digit',
            'double'    => 'digit',
            'date'      => 'date',
            'timestamp' => 'datetime',
            'boolean'   => 'boolean',
            'bool'      => 'boolean',
            'enum'      => 'select'
        );
        $column = array_merge($default, $columns[$name]);
        $group = isset($groups[$column['type']]) ? $groups[$column['type']] : 'string';
        
        extract($column);
        
        if ($name == 'id') {
            return FormHelper::hidden($name, $name);
        }
        if ($name == 'password') {
            return FormHelper::password($name, $name);
        }
        if ($group == 'string' && $length > 200 && $length <= 255) {
            return FormHelper::textarea($name, $name);                
        }
        if ($group == 'text' && $length && $length <= 255) {
            return FormHelper::textarea($name, $name);                
        }
        if ($group == 'text') {
            return FormHelper::textarea($name, 'editor '.$name, array('class' => 'editor'));                
        }
        if ($group == 'boolean') {
            return FormHelper::radios($name, array('0' => 'Oui', '1' => 'Non'), 1);                
        }
        if ($group == 'date') {
            return FormHelper::date($name, 'TODAY()', array(2000, 2010));                
        }
        if ($group == 'datetime') {
            return FormHelper::datetime($name, $name, array(2000, 2010));
        }
        if ($group == 'digit') {
            return FormHelper::text($name, $length, array('maxlength' => $length, 'size' => $length+5));                
        }
        if ($group == 'select') {
            return FormHelper::select($name, $values, '1');                
        }
        return FormHelper::text($name, '');
    }
    
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
