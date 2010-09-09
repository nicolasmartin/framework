<?php
class ImageHelper extends Helper {
    public static function thumbnail($src, $width, $height = null) {
        $html = '<img src="image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '&mode=crop"'.Helper::xhtml().'>';
        return $html;
    }

    public static function zoom($src, $width, $height = null) {
        $html = '<img src="image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '&mode=zoom"'.Helper::xhtml().'>';
        return $html;
    }

    public static function image($src, $width, $height = null) {
        $html = '<img src="image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '"'.Helper::xhtml().'>';
        return $html;
    }
}