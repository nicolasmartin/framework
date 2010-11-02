<?php
	class GeneratorStructure extends Generator {
		protected $overwrite = false;
				
		function __construct($app = 'generated', $controller = 'generated', $model = 'generated', $path = '.') {
			$this->setVar('app', $app);
			$this->setVar('controller', $controller);
			$this->setVar('model', $model);
			$this->setPath($path);
		}

		function setOverwrite($overwrite) {
			$this->overwrite = $overwrite;
		}
		
		function getOverwrite() {
			return $this->overwrite;
		}

		function generate() {
			$this->generateStructure();
		}
		
		function generateStructure() {
			$this->debug('---------------------------------');
			$this->debug('Structure');
			$this->debug('---------------------------------');

            $from   = $this->getPath().'/skeleton';
            $to     = ROOT;
            
            $this->copy($from, $to, $this->getOverwrite());
		}
	}

	