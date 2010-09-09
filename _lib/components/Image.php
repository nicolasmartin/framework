<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'../_lib/vendors/phpthumb/ThumbLib.inc.php');
    	
    class ImageComponent extends GdThumb {
        public function __construct($filename, $options = array(), $isDataStream = false) {
          $default = array(
							'resizeUp'				=> true,
							'jpegQuality'			=> 80,
							'correctPermissions'	=> true,
							'preserveAlpha'			=> true,
							'alphaMaskColor'		=> array (255, 255, 255),
							'preserveTransparency'	=> true,
							'transparencyMaskColor'	=> array (0, 0, 0)
					);
					$options = array_merge($default, $options);
          parent::__construct($filename, $options, $isDataStream);
        }

        public function thumbnail($width, $height = null) {
            return parent::adaptiveResize($width, $height);
        }

        public function zoom($width, $height = null) {
            return parent::cropFromCenter($width, $height);
        }

        public function rotate($value) {
            if (ctype_digit($value)) {
                return parent::rotateImageNDegrees($value);
            } else {
                return parent::rotateImage($value);
            }
        }

        public function __toString() {
            return parent::getImageAsString();
        }
    }