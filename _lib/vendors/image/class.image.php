<?php
	class Image	{
		public $source;
		public $destination;
		public $compression;
		public $width;
		public $height;
		public $sourceWidth;
		public $sourceHeight;
		public $ratio;
		public $mode;
		public $type;
		public $cropLeft;
		public $cropTop;
		public $cropWidth;
		public $cropHeight;
		public $bgR;
		public $bgG;
		public $bgB;
				
		// contructor waiting for a image path or image data string
		public function __construct($source)	{			
			if (file_exists($source) || substr($source, 0, 7) == "http://")	{
				$source = file_get_contents($source);
			} 
			if (substr($source, 1, 3) == "PNG") {
				$this->type = "png";
			} else if (substr($source, 0, 3) == "GIF") {
				$this->type = "gif";
			} else if (substr($source, 6, 4) == "JFIF") {
				$this->type = "jpeg";
			} else {
				$this->type = "jpeg";	
			}
			
			$this->source 		= imagecreatefromstring($source);
			$this->compression 	= 80;
			$this->ratio 		= 1;
			$this->width 		= 0;
			$this->height 		= 0;
			$this->cropLeft 	= 0;
			$this->cropTop 		= 0;
			$this->cropWidth 	= 0;
			$this->cropHeight 	= 0;
			$this->bgR 			= false;
			$this->bgG 			= false;
			$this->bgB			= false;
			$this->sourceWidth 	= imagesx($this->source);
			$this->sourceHeight = imagesy($this->source);
			$this->mode 		= "crop";
		}

		// set cropping coords
		public function crop($cropLeft = false, $cropTop = false, $cropWidth = false, $cropHeight = false)	{
			if ($cropLeft && $cropTop && $cropWidth && $cropHeight)	{
				$this->cropLeft 	= $cropLeft;
				$this->cropTop 		= $cropTop;
				$this->cropWidth 	= $cropWidth;
				$this->cropHeight 	= $cropHeight;
			}
			return array("left"=>$this->cropLeft, "top"=>$this->cropTop, "width"=>$this->cropWidth, "height"=>$this->cropHeight);
		}
		
		// set or get the width of the destination picture
		public function width($width = false)	{
			if ($width)	$this->width = $width;
			return $this->width;
		}	
		
		// set or get the height of the destination picture
		public function height($height = false)	{
			if ($height) $this->height = $height;
			return $this->height;
		}
		
		// set width and height or the max size of the destination picture
		public function size($value1 = false, $value2 = false)	{
			if ($value1 && !$value2)	{
				if ($this->sourceWidth > $this->sourceHeight && $this->sourceWidth > $value1)	{
					$this->width  = $value1;
					$this->height = 0; 
				}
				if ($this->sourceHeight > $this->sourceWidth && $this->sourceHeight > $value1)	{
					$this->width  = 0;
					$this->height = $value1; 
				}
			} else if ($value1 && $value2)	{
				$this->width = $value1;
				$this->height = $value2;
			}
			return array("width"=>$this->width, "height"=>$this->height);
		}	

		// set or get the type destination picture
		public function type($type = false)	{
			if ($type)	$this->type = $type;
			return $this->type;	
		}
		
		// set or get the comression rate of the destination picture
		public function compress($rate = false)	{
			if ($rate) $this->compression = $rate;
			return $this->compression;
		}

		// set the resizing mode
		public function mode($mode = false)	{
			if ($mode) $this->mode = $mode;
			return $this->mode;
		}

		// calculate the resizing ratio
		public function ratio($ratio = false)	{
			if ($ratio == false) {
				if ($this->width && !$this->height)	{
					$this->ratio = $this->width / $this->sourceWidth;
				} else if (!$this->width && $this->height)	{
					$this->ratio = $this->height / $this->sourceHeight;
				}
			} else {
				$this->ratio = $ratio;
			}
			return $this->ratio;
		}
		
		public function background($value1 = false, $value2 = false, $value3 = false) {
			if ($value1 == "transparent")	{
				$this->bgR = false;
				$this->bgG = false;
				$this->bgB = false;
			} else if ($value1 && !$value2 && !$value3)	{
				$value1 = str_replace("#", "", $value1);
				$this->bgR = hexdec(substr($value1, 0, 2));
				$this->bgG = hexdec(substr($value1, 2, 2));
				$this->bgB = hexdec(substr($value1, 4, 2));		
			} else if ($value1 && $value2 && $value3)	{
				$this->bgR = $value1;
				$this->bgG = $value2;
				$this->bgB = $value3;
			}
			return array("red"=>$this->bgR, "green"=>$this->bgG, "blue"=>$this->bgB);
	    }

		// get the new picture
		public function spit($destination = false)	{
			$width  		= (!$this->width)  ? $this->sourceWidth  * $this->ratio() : $this->width; 
			$height 		= (!$this->height) ? $this->sourceHeight * $this->ratio() : $this->height;
			$sourceWidth 	= $this->sourceWidth;
			$sourceHeight 	= $this->sourceHeight;
			$type 			= $this->type;

			$this->destination = imagecreatetruecolor($width, $height);
			if ($this->bgR === false && $this->bgG === false && $this->bgB === false)	{
				$backgroundColor = imagecolorallocatealpha($this->destination, 0, 0, 0, 127);
				imagesavealpha($this->destination, true);
				imagecolortransparent($this->destination, $backgroundColor);
			} else {
				$backgroundColor = imagecolorallocate($this->destination, $this->bgR, $this->bgG, $this->bgB);
			}
			imagefill($this->destination, 0, 0, $backgroundColor);
	
			$xd = 0; 
			$yd = 0;
			$xs = 0;
			$ys = 0;
			$wd = $width;
			$hd = $height;
			$ws = $sourceWidth;
			$hs = $sourceHeight;
			if ($this->cropLeft && $this->cropTop)	{
				$xs = $this->cropLeft;
				$ys = $this->cropTop;
				$ws = $this->cropWidth;
				$hs = $this->cropHeight;
			} else if($this->mode == "preserve") {
				if ($sourceWidth < $sourceHeight)	{
					$wd = $sourceWidth / ($sourceHeight / $height);
					$xd = -(($wd - $width) / 2);
				} else {
					$hd = $sourceHeight / ($sourceWidth / $width);
					$yd = -(($hd - $height) / 2);
				}
			} else if ($this->mode == "crop") {
				if ($sourceWidth < $sourceHeight)	{
					$hd = $sourceHeight / ($sourceWidth / $width);
					$yd = -(($hd - $height) / 2);
				} else {
					$wd = $sourceWidth / ($sourceHeight / $height);
					$xd = -(($wd - $width) / 2);
				}
			} else if ($this->mode == "strech") {
				// nothing;
			}
			imagecopyresampled($this->destination, $this->source, $xd, $yd, $xs, $ys, $wd, $hd,	$ws, $hs);

			// no destination defined, so the picture is displayed
			if ($destination === false)	{
				if ($type == "png")	{
					header("Content-Type: image/png");
					imagepng($this->destination);		
				} else if ($type == "gif")	{
					header("Content-Type: image/gif");
	  		 		imagegif($this->destination);
				} else {
					header("Content-Type: image/jpeg");
	  		 		imagejpeg($this->destination, null, $this->compression);
				}
				imagedestroy($this->destination);
				return true;
			// destination is set to true, picture data is returned
			} else if ($destination === true)	{
				ob_start();
				if ($type == "png")	{
	  		 		imagepng($this->destination);
				} else if ($type == "gif")	{
	  		 		imagegif($this->destination);
				} else {
	  		 		imagejpeg($this->destination, null, $this->compression);
				}
	  			$data = ob_get_contents();
				ob_end_clean();
				imagedestroy($this->destination);
				return $data;
			// destination is set, picture file is created
			} else {
				if ($type == "png")	{
	  		 		imagepng($this->destination, $destination);
				} else if ($type == "gif")	{
	  		 		imagegif($this->destination, $destination);
				} else {
	  		 		imagejpeg($this->destination, $destination, $this->compression);
				}
				imagedestroy($this->destination);
				return true;
			}
		}
		
		public function destroy() {
			imagedestroy($this->source);
			imagedestroy($this->destination);
		}
	}