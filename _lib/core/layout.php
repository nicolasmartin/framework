<?php
	abstract class LayoutCore extends ViewCore {	
		public function setPath($path) {
			$this->path = InflectionComponent::smartPath($path, '_layouts');
		}
	}