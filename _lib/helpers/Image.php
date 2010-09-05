<?php
class ImageHelper extends UrlComponent {
    public static function thumbnail($src, $width, $height = null) {
        $html = '<img src="image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '&mode=crop" />';
        return $html;
    }

    public static function zoom($src, $width, $height = null) {
        $html = '<img src="image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '&mode=zoom" />';
        return $html;
    }

    public static function display($src, $width, $height = null) {
        //http_build_query;
        $html = '<img src="image.php?src='.$src.'&width='.$width;
        if ($height)  {
            $html .= '&height='.$height;
        }
        $html .= '" />';
        return $html;
    }
}