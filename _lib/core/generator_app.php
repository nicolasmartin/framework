<?php
	class GeneratorApp {
		protected $app;
		protected $path;
		protected $protection 	= true;
		protected $verbose 		= true;
		protected $settings 	= array();

		protected $overwriteApp	= false;
		protected $overwriteWww	= false;
				
		function __construct($app, $path = '.', $settings = array()) {
			$this->setApp($app);
			$this->setPath($path);
			$this->setSettings($settings);
		}

		function setApp($app) {
			$this->app = strtolower($app);
		}
		
		function getApp() {
			return $this->app;
		}

		function setPath($path) {
			$this->path = $path;
		}

		function getPath() {
			return $this->path;
		}
		
		function setSettings($settings = array()) {
			$this->settings = $settings;
		}

		function getSettings() {
			return $this->settings;
		}
		
		function setOverwriteAll($overwrite) {
			$this->overwriteApp = $overwrite;
			$this->overwriteWww = $overwrite;
		}
		
		function setOverwriteApp($overwrite) {
			$this->overwriteApp = $overwrite;
		}

		function getOverwriteApp() {
			return $this->overwriteApp;
		}
		
		function setOverwriteWww($overwrite) {
			$this->overwriteWww = $overwrite;
		}
		
		function getOverwriteWww() {
			return $this->overwriteApp;
		}

		function setVerbose($verbose) {
			$this->verbose = $verbose;	
		}

		function getVerbose() {
			return $this->verbose;	
		}

		function generateAll() {
			$this->generateApp();
			$this->generateWww();
		}
		
		function generateApp() {
			$this->debug('---------------------------------');
			$this->debug('App '.$this->getApp());
			$this->debug('---------------------------------');

			$templates = read_folder('app');

			foreach($templates as $template) {
				$from 	= $this->getPath().'/app/'.$template;
				$to 	= ROOT.'/apps/'.$this->getApp().'/'.$template;
				
				if (!file_exists(dirname($to))) {
					mkdir(dirname($to), 0700, true);
				}
				
				if (file_exists($to) && $this->getOverwriteApp() === false) {
					$this->debug('Le fichier existe déjà. '.$to.' est ignoré.');	
				} else {
					$this->debug('Création du fichier '.$to.'.');
					copy($from, $to);
				}
			}
		}
		
		function generateWww() {
			$this->debug('---------------------------------');
			$this->debug('WWW '.$this->getApp());
			$this->debug('---------------------------------');

			$templates = read_folder('www');

			foreach($templates as $template) {
				$from 	= $this->getPath().'/www/'.$template;
				$to 	= ROOT.'/www/'.$this->getApp().'/'.$template;
				
				if (!file_exists(dirname($to))) {
					mkdir(dirname($to), 0700, true);
				}
				
				if (file_exists($to) && $this->getOverwriteWww() === false) {
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

	