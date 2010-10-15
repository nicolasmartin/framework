<?php
	class Layout extends View {	
		public function setPath($path, $smart = false) {
			if ($smart) {
				$this->path = VIEWS.'/_layouts/'.$path.'.tpl.php';			
			} else {
				$this->path = $path;
			}
		}
	}