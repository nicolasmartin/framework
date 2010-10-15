<?php
	class GeneratorFramework {
		protected $path;
		protected $verbose = true;
		protected $overwriteFramework	= false;
				
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
			$this->overwriteFramework = $overwrite;
		}
		
		function setOverwriteFramework($overwrite) {
			$this->overwriteFramework = $overwrite;
		}

		function getOverwriteFramework() {
			return $this->overwriteFramework;
		}

		function setVerbose($verbose) {
			$this->verbose = $verbose;	
		}

		function getVerbose() {
			return $this->verbose;	
		}

		function generateAll() {
			$this->generateFramework();
		}
		
		function generateFramework() {
			$this->debug('---------------------------------');
			$this->debug('Framework');
			$this->debug('---------------------------------');

			$templates = read_folder('skeleton');

			foreach($templates as $template) {
				$from 	= $this->getPath().'/skeleton/'.$template;
				$to 	= ROOT.'/'.$template;
				
				if (!file_exists(dirname($to))) {
					mkdir(dirname($to), null, true);
				}
				
				if (file_exists($to) && $this->getOverwriteFramework() === false) {
					$this->debug('Le fichier existe déjà. '.$to.' est ignoré.');	
				} else {
					$this->debug('Création du fichier '.$to.'.');
					copy($from, $to);
				}
			}
		}

		private function debug($string) {
			 if(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR'])) {
				  $nl = "\n";
			 } else {
				  $nl = "<br />";
			 }
			 if ($this->getVerbose()) {
				 echo str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', $string), $nl;
			 }
		}
	}

	