<?php
	class GeneratorApp extends Generator {
		protected $app;
		protected $path;
		protected $protection 	= true;
		protected $settings 	= array();

		protected $overwriteApp	    = false;
        protected $overwriteWww     = false;
        protected $overwriteModels  = false;
				
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

		function setOverwriteModels($overwrite) {
			$this->overwriteModels = $overwrite;
		}

		function getOverwriteModels() {
			return $this->overwriteModels;
		}
		
		function generateAll() {
			$this->generateApp();
			$this->generateModels();
			$this->generateWww();
		}
		
		function generateApp() {
			$this->debug('---------------------------------');
			$this->debug('App '.$this->getApp());
			$this->debug('---------------------------------');

            $from   = $this->getPath().'/app';
            $to     = ROOT.'/apps/'.$this->getApp();
            
            $this->copy($from, $to, $this->getOverwriteApp());
		}
		
		function generateWww() {
			$this->debug('---------------------------------');
			$this->debug('WWW '.$this->getApp());
			$this->debug('---------------------------------');

            $from   = $this->getPath().'/www';
            $to     = ROOT.'/www/'.$this->getApp();
            
            $this->copy($from, $to, $this->getOverwriteWww());
		}
		
		function generateModels() {
			$this->debug('---------------------------------');
			$this->debug('Models '.$this->getApp());
			$this->debug('---------------------------------');

            $from   = $this->getPath().'/models';
            $to     = ROOT.'/models';
            
            $this->copy($from, $to, $this->getOverwriteModels());
		}
	}

	