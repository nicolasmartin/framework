<?php
	abstract class LayoutCore extends ViewCore {	
		public function setPath($path) {
			$this->path = Inflection::smartPath($path, '_layouts');
		}
	}