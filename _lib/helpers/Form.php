<?php
class FormHelper extends Helper {
    
    static function text($name, $value='', $attributes = array()) {
        $attributes['value'] = $value;
        $html = '<input type="text" id="'.$name.'" name="'.$name.'" '.self::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }

    static function password($name, $value='', $attributes = array()) {
        $attributes['value'] = $value;
        $html = '<input type="password" id="'.$name.'" name="'.$name.'" '.self::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }

    static function checkbox($name, $value='', $checked = '', $attributes = array()) {
        $attributes['value'] = $value;
        $html = '<input type="checkbox" name="'.$name.'" '.self::attributes($attributes);
        if ($value == $checked) {
            $html .= ' checked="checked"';
        }
        $html .= Helper::xhtml().'>';
        return $html;
    }
    
    static function checkboxes($name, $checked='', $options  = array(), $attributes = array()) {
        $html = '';
        foreach($options as $key => $value) {
            $attributes['value'] = $key;
            $html .= '<input type="checkbox" name="'.$name.'" '.self::attributes($attributes);
            if ($key == $checked || (is_array($checked) && in_array($key, $checked))) {
                $html .= ' checked="checked"';                
            }
            $html .= Helper::xhtml().'> ';
            $html .= $value.' ';
        }
        return $html;
    }
    
    static function radio($name, $value='', $checked = '', $attributes = array()) {
        $attributes['value'] = $value;
        $html = '<input type="radio" name="'.$name.'" '.self::attributes($attributes);
        if ($value == $checked) {
            $html .= ' checked="checked"';
        }
        $html .= Helper::xhtml().'>';
        return $html;
    }
    
    static function radios($name, $checked='', $options  = array(), $attributes = array()) {
        $html = '';
        foreach($options as $key => $value) {
            $attributes['value'] = $key;
            $html .= '<input type="radio" name="'.$name.'[]" '.self::attributes($attributes);
            if ($key == $checked || (is_array($checked) && in_array($key, $checked))) {
                $html .= ' checked="checked"';                
            }
            $html .= Helper::xhtml().'> ';
            $html .= $value.' ';
        }
        return $html;
    }
    
    static function hidden($name, $value='', $attributes = array()) {
        $attributes['value'] = $value;
        $html = '<input type="hidden" id="'.$name.'" name="'.$name.'" '.self::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }
    
    static function textarea($name, $value='', $attributes = array()) {
        $html = '<textarea id="'.$name.'" name="'.$name.'" '.self::attributes($attributes).'>';
        $html .= $value;
        $html .= '</textarea>';
        return $html;
    }

    static function select($name, $options  = array(), $selected='', $attributes = array()) {
        if (isset($attributes['empty'])) {
           $empty = $attributes['empty'];
           unset($attributes['empty']);
        }
        $html = '<select id="'.$name.'" name="'.$name.'" '.self::attributes($attributes).'>';
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

    static function date($name, $value='', $years = array(), $attributes = array()) {
        $date = $time = $year = $month = $day = null;
        if ($value == 'NOW()' || $value == 'TODAY()') {
            $value = date('Y-m-d');
        }
        if (@list($date, $time) = explode(' ', $value)) {
            @list($year, $month, $day) = explode('-', $date);
        }
        $days = array();
        for($i = 1; $i <= 31; $i++) {
            $days[] = sprintf('%02d' , $i);
        }
        $months = array();
        for($i = 1; $i <= 12; $i++) {
            $months[sprintf('%02d' , $i)] = strftime('%B', strtotime('2000-'.$i.'-01'));
        }
        $html  = '';
        $html .= self::select($name.'_day', array_combine($days, $days), $day, $attributes);
        $html .= self::select($name.'_month', array_combine(array_keys($months), $months), $month, $attributes);
        $html .= self::select($name.'_year', array_combine($years, $years), $year, $attributes);
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

	static function getHasErrorClass($field, $Model, $full = true) {
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			if ($full) {
				return 'class="has-error"';
			}
			return 'has-error';
		}
		return "";	
	}
		
	static function getErrorClass($field, $Model, $full = true) {
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			if ($full) {
				return 'class="error"';
			}
			return 'error';
		}
		return "";	
	}
	
	static function displayErrors($field, $Model) {
		$html = "";
		$stack = $Model->getErrorStack();
		if (isset($stack[$field])) {
			$html .= '<ul class="errors">';
			foreach($stack[$field] as $key) {
				if (isset($Model->messages[$field][$key])) {
					$html .= '<li>'.$Model->messages[$field][$key].'</li>';
				} else {
					$html .= '<li>Erreur inconnue : '.$key.'</li>';
				}
			}	
			$html .= '</ul>';
		}
		return $html;
	}
}
?>