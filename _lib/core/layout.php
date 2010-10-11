<?php
	abstract class LayoutCore extends ViewCore {	
		public function setPath($path) {
			if ($this->smartPath == true) {
				$this->path = InflectionComponent::smartPath($path, '_layouts');
			} else {
				$this->path = $path;
			}
		}
	}