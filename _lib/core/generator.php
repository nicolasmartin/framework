<?php
	class GeneratorCore {
		protected $app, $controller, $model;
		protected $protection 	= true;
		protected $overwrite 	= false;
		protected $verbose 		= false;
		protected $settings 	= array();
		protected $exclude 		= array();
		protected $mapping 		= array();
		protected $packs 		= array();
		
		function __construct($app = null, $controller = null, $model = null, $path = null, $settings = array()) {
			$this->setApp($app);
			$this->setController($controller);
			$this->setModel($model);
			$this->setSettings($settings);
			$this->setPath($path);
		}

		function setApp($app) {
			$this->app = strtolower($app);
		}
		
		function getApp() {
			return $this->app;
		}
		
		function setController($controller) {
			$this->controller = ucfirst(strtolower($controller));
		}
			
		function getController() {
			return $this->controller;
		}
		
		function setModel($model) {
			$this->model = ucfirst(strtolower($model));
		}

		function getModel() {
			return $this->model;
		}
		
		function setPath($path) {
			require_once($path.'/ThisGeneratorHelper.php');
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
		
		function setExclude($exclude = array()) {
			$this->settings['exclude'] = $exclude;
			$this->exclude = $exclude;
		}
		
		function getExclude() {
			return $this->exclude;
		}
		
		function setMapping($mapping = array()) {
			$this->mapping = $mapping;
			$this->settings['map'] = $mapping;
		}
		
		function getMapping() {
			return $this->mapping;
		}
		function setProtection($protection) {
			$this->protection = $protection;
		}
		
		function getProtection() {
			return $this->protection;
		}
		
		function setOverwrite($overwrite) {
			$this->overwrite = $overwrite;
		}
		
		function getOverwrite() {
			return $this->overwrite;
		}

		function setVerbose($verbose) {
			$this->verbose = $verbose;	
		}

		function getVerbose() {
			return $this->verbose;	
		}
		
		function generate() {
			$this->generateController();
			$this->generateViews();
		}
		
		function addPack($pack) {
			$this->packs[$pack] = $pack;
		}
		
		function removePack($pack) {
			if (isset($this->packs[$pack])) {
				unset($this->packs[$pack]);
			}
		}
		
		function generateController() {
			$template_path = $this->getPath().'/controllers';
			$templates = $this->getTemplates($template_path);
			$class = '';
			
			$this->debug('---------------------------------');
			$this->debug('Controller '.$this->getController());
			$this->debug('---------------------------------');
			
			foreach($templates as $file) {
				$View = new View($template_path.'/'.$file, null, false);
				$View->set('protection',	$this->getProtection());
				$View->set('app', 			$this->getApp());
				$View->set('controller', 	$this->getController());
				$View->set('model', 		$this->getModel());
				$View->set('settings', 		$this->getSettings());
			
				$class .= $View->render();
				
				$this->debug('- '.$file);
			}
			
			$Base = new View($template_path.'/base.tpl.php', null, false);
			$Base->set('protection',	$this->getProtection());
			$Base->set('app', 			$this->getApp());
			$Base->set('controller', 	$this->getController());
			$Base->set('model', 		$this->getModel());
			$View->set('settings', 		$this->getSettings());
			$Base->set('class', 		$class);
			
			$generated = $Base->render();
			$generated = str_replace('[?', '<?', $generated);
			$generated = str_replace('?]', '?>', $generated);

			$this->debug('Les templates sont intégrés dans base.tpl.php');
			
			if ($this->getApp() == '') {
				$path = CONTROLLERS.'default/'.$this->getController().'.php';
			} else {
				$path = CONTROLLERS.strtolower($this->getApp()).'/'.$this->getController().'.php';
			}

			if (file_exists($path) && $this->getOverwrite() === false) {
				throw new Exception('Le controller '.$path.' existe déjà.');	
			} 

			file_put_contents($path, $generated);

			$this->debug('Génération totale du controller dans '.dirname($path));
		}
		
		function generateViews() {
			$template_path = $this->getPath().'/views';
			$templates = $this->getTemplates($template_path);

			$this->debug('---------------------------------');
			$this->debug('Vues pour le controller '.$this->getController());
			$this->debug('---------------------------------');
				
			foreach($templates as $file) {
				$View = new View($template_path.'/'.$file, null, false);
				$View->set('protection',	$this->getProtection());
				$View->set('app', 			$this->getApp());
				$View->set('controller', 	$this->getController());
				$View->set('model', 		$this->getModel());
				$View->set('settings', 		$this->getSettings());
			
				$generated = $View->render();
				$generated = str_replace('[?', '<?', $generated);
				$generated = str_replace('?]', '?>', $generated);
			
				if ($this->getApp() == '') {
					$path = VIEWS.'default/'.strtolower($this->getController()).'/'.$file;
				} else {
					$path = VIEWS.strtolower($this->getApp()).'/'.strtolower($this->getController()).'/'.$file;
				}

				foreach($this->packs as $pack) {
					$dir = strtolower($this->getController());
					$path = preg_replace('~/'.$dir .'/'.$pack.'/~', '/'.$dir.'/', $path);
				}

				if (!file_exists(dirname($path))) {
					mkdir(dirname($path));
					$this->debug('Création du dossier '.dirname($path));
				}
				
				if (file_exists($path) && $this->getOverwrite() === false) {
					throw new Exception('La vue '.$path.' existe déjà.');	
				}
			
				file_put_contents($path, $generated);

				$this->debug('- '.$file);
			}
					
			$this->debug('Génération totale des vues dans '.dirname($path));
		}
		
		private function getTemplates($path) {
			$templates = array();
			$handle = opendir($path);
			if (!$handle) {
				throw new Exception('Le dossier de template ne semble pas correct');	
			}
			while ($file = readdir($handle)) {
				if (strpos($file, '.tpl.php') !== false && $file != 'base.tpl.php') {
					$templates[] = $file;
				}
			}
			closedir($handle);

			foreach($this->packs as $pack) {
				$path = $path.'/'.$pack;
				if (is_dir($path)) {
					$handle = opendir($path);
					while ($file = readdir($handle)) {
						if (strpos($file, '.tpl.php') !== false) {
							$templates[] = basename($path).'/'.$file;
						}
					}
					closedir($handle);
				} else {
					throw new Exception("Le pack ".$pack." n'existe pas.");	
				}
			}

			return $templates;
		}
		
		private function debug($string) {
			 if(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR'])) {
				  $nl = "\n";
			 } else {
				  $nl = "<br />";
			 }
			 if ($this->getVerbose()) {
				 echo $string, $nl;
			 }
		}
	}

	