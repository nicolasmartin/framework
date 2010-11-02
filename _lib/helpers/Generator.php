<?php
class GeneratorHelper extends Helper {
	
    static function getFormHint($model, $field) {
        $columns = Doctrine::getTable($model)->getColumns();
 		$column = $columns[$field];
		
		if (isset($column['notblank']) && $column['notblank'] == true) {
			return '<small class="hint">'.__("Champs obligatoire").'</small>';
		}
		return '';
	}
	
    static function getFormElement($model, $field, $alias = null) {
		if (!$alias) {
			$alias = $model;
		}
        
		$model = ucfirst($model);
		$alias = ucfirst($alias);
		
        $columns = Doctrine::getTable($model)->getColumns();     
        $default = array(
            'type'      => null,
            'length'    => null,
        );
		// Types Doctrine : 
		// http://www.symfony-project.org/doctrine/1_2/en/04-Schema-Files
        $groups = array(
            'string'    => 'string',
            'char'      => 'string',
            'varchar'   => 'string',
            'blob'      => 'text',
            'clob'      => 'text',
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
        $column = array_merge($default, $columns[$field]);
        $group = isset($groups[$column['type']]) ? $groups[$column['type']] : 'string';
        
        extract($column);
		
        if ($field == 'id') {
            return "FormHelper::hidden('".$field."', $".$alias.");";
        }
        if (contains($field,'*password')) {
            return "FormHelper::password('".$field."', $".$alias.");";
        }
        if ($group == 'string' && $length == 255) {
            return "FormHelper::textarea('".$field."', $".$alias.", array('cols' => 100, 'rows' => 4));";
        }
        if ($group == 'text' && $length && $length <= 255) {
            return "FormHelper::textarea('".$field."', $".$alias.", array('class' => 'editor-tiny', 'cols' => 120, 'rows' => 10));";
        }
        if ($group == 'text' && (!$length || $length > 255)) {
            return "FormHelper::textarea('".$field."', $".$alias.", array('class' => 'editor', 'cols' => 140, 'rows' => 40));";
        }
        if ($group == 'boolean') {
            return "FormHelper::radios('".$field."', array('0' => __('Oui'), '1' => __('Non')), $".$alias.");";       
        }
        if ($group == 'date') {
            return "FormHelper::date('".$field."', 'TODAY()');";    
        }
        if ($group == 'datetime') {
            return "FormHelper::datetime('".$field."', $".$alias.");";
        }
        if ($group == 'digit') {
            return "FormHelper::text('".$field."', $".$alias.", array('maxlength' => ".$length.", 'size' => ".($length+1)."));";        
        }
        if ($group == 'select') {
            return "FormHelper::select('".$field."', $".$alias.", '1');";  
        }
        return "FormHelper::text('".$field."', $".$alias.", array('size' => 100));"; 
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
} 
