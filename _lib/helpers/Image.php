<?php
class ImageHelper extends Helper {
    public static function thumbnail($src, $width, $height = null, $attributes = array()) {
				if (is_array($height)) {
					$attributes = $height;
					$height = $width;
				}
        $html = '<img src="/image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '&mode=crop';
        $html .= '"';
        $html .= Helper::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }

    public static function zoom($src, $width, $height = null, $attributes = array()) {
				if (is_array($height)) {
					$attributes = $height;
					$height = $width;
				}
        $html = '<img src="/image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '&mode=zoom';
        $html .= '"';
        $html .= Helper::attributes($attributes);
        $html .= '"'.Helper::xhtml().'>';
        return $html;
    }

    public static function image($src, $width, $height = null, $attributes = array()) {
				if (is_array($height)) {
					$attributes = $height;
					$height = $width;
				}
        $html = '<img src="/image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '"';
        $html .= Helper::attributes($attributes);
        $html .= Helper::xhtml().'>';
        return $html;
    }
}