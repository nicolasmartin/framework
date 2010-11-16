<?php
class FormHelper extends Helper {
    
    static function text($name, $value = '', $attributes = array()) {
        $attributes['value'] = is_object($value) ? $value[$name] : $value;
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $name;
        $html = '<input type="text" name="'.$name.'" '.self::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }

    static function password($name, $value = '', $attributes = array()) {
        $attributes['value'] = is_object($value) ? $value[$name] : $value;
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $name;
        $html = '<input type="password" name="'.$name.'" '.self::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }

    static function hidden($name, $value = '', $attributes = array()) {
        $attributes['value'] = is_object($value) ? $value[$name] : $value;
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $name;
        $html = '<input type="hidden" name="'.$name.'" '.self::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }
    
    static function textarea($name, $value = '', $attributes = array()) {
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $name;
        $html = '<textarea name="'.$name.'" '.self::attributes($attributes).'>';
        $html .= is_object($value) ? $value[$name] : $value;
        $html .= '</textarea>';
        return $html;
    }
    
    static function checkbox($name, $value = '', $checked = '', $attributes = array()) {
        $attributes['value'] = $value = is_object($value) ? $value[$name] : $value;
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $name;
        $html = '<input type="checkbox" name="'.$name.'" '.self::attributes($attributes);
        if ($value == $checked) {
            $html .= ' checked="checked"';
        }
        $html .= Helper::xhtml().'>';
        return $html;
    }
    
    static function checkboxes($name, $options  = array(), $checked = '', $attributes = array()) {
        $checked = is_object($checked) ? $checked[$name] : $checked;
        $html = '<div class="checkboxes">';
        foreach((array) $options as $key => $value) {
            $attributes['value'] = $key;
			$html .= '<label>';
            $html .= '<input type="checkbox" name="'.$name.'" '.self::attributes($attributes);
            if ($key == $checked || (is_array($checked) && in_array($key, $checked))) {
                $html .= ' checked="checked"';                
            }
            $html .= Helper::xhtml().'> ';
            $html .= $value;
			$html .= '</label> ';
        }
		$html .= '</div>';
        return $html;
    }
    
    static function radio($name, $value = '', $checked = '', $attributes = array()) {
        $attributes['value'] = $value = is_object($value) ? $value[$name] : $value;
        $html = '<input type="radio" name="'.$name.'" '.self::attributes($attributes);
        if ($value == $checked) {
            $html .= ' checked="checked"';
        }
        $html .= Helper::xhtml().'>';
        return $html;
    }
    
    static function radios($name, $options = array(), $checked = '', $attributes = array()) {
        $checked = is_object($checked) ? $checked[$name] : $checked;
	    $html = '<div class="radios">';
        foreach((array) $options as $key => $value) {
            $attributes['value'] = $key;
			$html .= '<label>';
            $html .= '<input type="radio" name="'.$name.'" '.self::attributes($attributes);
            if ($key == $checked || (is_array($checked) && in_array($key, $checked))) {
                $html .= ' checked="checked"';                
            }
            $html .= Helper::xhtml().'> ';
            $html .= $value;
			$html .= '</label> ';
        }
		$html .= '</div>';
        return $html;
    }

    static function select($name, $options  = array(), $selected = '', $attributes = array()) {
        $selected = is_object($selected) ? $selected[$name] : $selected;
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $name;
        if (isset($attributes['empty'])) {
           $empty = $attributes['empty'];
           unset($attributes['empty']);
        }
        $html = '<select name="'.$name.'" '.self::attributes($attributes).'>';
        if (isset($empty)) {
           $html .= '<option value="">'.$empty.'</option>';
        }
        foreach($options as $key => $value) {
                $html .= '<option value="'.$key.'"'; 
            if ($key == $selected || (is_array($selected) && in_array($key, $selected))) {
                $html .= ' selected="selected"';                
            }
            $html .= '>'.$value.'</option>'; 
        }
        $html .= '</select>';
        return $html;
    }

    static function date($name, $value = '', $years = array(), $attributes = array()) {
        $prefix = '_'.$name.'_';
        $value 	= is_object($value) ? $value[$name] : $value;
        $date 	= $time = null;
		$year 	= $month = $day = null;
		
        if (!$value || $value == 'NOW()' || $value == 'TODAY()') {
            $value = date('Y-m-d');
        }
        if (@list($date, $time) = explode(' ', $value)) {
            @list($year, $month, $day) = explode('-', $date);
        }

		if (!$years) {
			$years = array(date('Y'), date('Y')+5);	
		}
        $months = array();
        for($i = 1; $i <= 12; $i++) {
            $months[sprintf('%02d' , $i)] = utf8_encode(strftime('%B', strtotime('2000-'.$i.'-01')));
        }
        $days = array();
        for($i = 1; $i <= 31; $i++) {
            $days[] = sprintf('%02d' , $i);
        }

        $html  = '';
        $html .= self::select($prefix.'day', 	array_combine($days, $days), $day, $attributes);
        $html .= ' / ';
        $html .= self::select($prefix.'month', 	array_combine(array_keys($months), $months), $month, $attributes);
        $html .= ' / ';
		$html .= self::select($prefix.'year', 	array_combine($years, $years), $year, $attributes);
        return $html;
    }
    
    static function datetime($name, $value = '', $years = array(), $attributes = array()) {
        $prefix = '_'.$name.'_';
		$value 	= is_object($value) ? $value[$name] : $value;
        $date 	= $time = null;
		$year 	= $month = $day = null;
		$hour 	= $minutes = $seconds = null;
		$with_seconds = null;
		
        if (!$value || $value == 'NOW()' || $value == 'TODAY()') {
            $value = date('Y-m-d H:i:s');
        }
        if (isset($attributes['seconds']) && $attributes['seconds'] == true) {
            $with_seconds = true;
            unset($attributes['seconds']);   
        }
        if (@list($date, $time) = explode(' ', $value)) {
            @list($year, $month, $day) = explode('-', $date);
			@list($hour, $minutes, $seconds) = explode(':', $time);
        }
		
        $html = self::date($name, $value, (array)$years, (array)$attributes);
        $html.= ' '.__('à').' ';
		$html .= FormHelper::text($prefix.'hour', $hour, array('size' => 2, 'maxlength' => 2));
        $html .= ' : ';
		$html .= FormHelper::text($prefix.'minutes', $minutes, array('size' => 2, 'maxlength' => 2));
        if ($with_seconds) {
            $html .= ' : ';
			$html .= FormHelper::text($prefix.'seconds', $seconds, array('size' => 2, 'maxlength' => 2));
        } else {
			$html .= FormHelper::hidden($prefix.'seconds', $seconds);
		}
        return $html;
    }
      
	static function isChecked($posted, $value, $default = false) {
		if ($posted == null) {
			if ($default == true) {
				return 'checked="checked"';
			}
		} else {
			if ($posted == $value) {
				return 'checked="checked"';
			}
		}
		return '';
	}

	static function isSelected($posted, $value, $default = false) {
		if ($posted == null) {
			if ($default == true) {
				return 'selected="selected"';
			}
		} else {
			if ($posted == $value) {
				return 'selected="selected"';
			}
		}
		return '';
	}

	static function getErrorClass($field, $Model, $full = true) {
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			if ($full) {
				return 'class="error"';
			}
			return 'error';
		}
		return '';	
	}
	
	static function displayErrors($field, $Model) {
		$html = "";
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			$html .= '<ul class="errors">';
			foreach($stack[$field] as $key) {
				if ($message = $Model->getErrorMessage($key, $field)) {
					$html .= '<li>'.$message.'</li>';
				} else {
					$html .= '<li>'.__('Erreur inconnue :').' '.$key.'</li>';
				}
			}	
			$html .= '</ul>';
		}
		return $html;
	}
}
?>