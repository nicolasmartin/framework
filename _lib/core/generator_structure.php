<?php
	class GeneratorStructure extends Generator {
		protected $path;
		protected $overwriteStructure = false;
				
		function __construct($path = '.') {
			$this->setPath($path);
		}

		function setPath($path) {
			$this->path = $path;
		}

		function getPath() {
			return $this->path;
		}

		function setOverwriteAll($overwrite) {
			$this->overwriteStructure = $overwrite;
		}
		
		function setOverwriteStructure($overwrite) {
			$this->overwriteStructure = $overwrite;
		}

		function getOverwriteStructure() {
			return $this->overwriteStructure;
		}

		function generateAll() {
			$this->generateStructure();
		}
		
		function generateStructure() {
			$this->debug('---------------------------------');
			$this->debug('Structure');
			$this->debug('---------------------------------');

            $from   = $this->getPath().'/skeleton';
            $to     = ROOT;
            
            $this->copy($from, $to, $this->getOverwriteStructure());
		}
	}

	