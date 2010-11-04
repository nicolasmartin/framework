<?php
	class GeneratorController2 extends Generator {
		protected $app, $controller, $model;
		protected $protection 	= true;
		protected $overwrite 	= false;

		protected $settings = array(
			'model'			=> "Item",
			'collection'	=> "Items",
			'singular'		=> "élément",
			'plural'		=> "éléments",
			'male'			=> true,
			'this' 			=> "cet ",
			'the' 			=> "l'",
			'a' 			=> "un ",
		);
		protected $exclude = array(
			'id',
			'slug',
			'created_at',
			'updated_at',
		);
		protected $mapping = array(
			'name'			=> "nom",
			'firstname'		=> "prénom",
			'username'		=> "identifiant",
			'password'		=> "mot de passe",
			'address'		=> "adresse",
			'postalcode'	=> "code postale",
			'city'			=> "ville",
			'phone'			=> "téléphone",
			'mobile'		=> "portable",
			'status'		=> "état",
			'path'			=> "chemin",
			'price'			=> "prix",
			'body'			=> "corps",
			'title'			=> "titre",
			'width'			=> "largeur",
			'height'		=> "hauteur",
			'created_at'	=> "créé",
			'updated_at'	=> "mis à jour",
		);
				
		function __construct($controller, $model = null, $app = null, $path = '.', $settings = array()) {
			$this->setApp($app);
			$this->setController($controller);
			$this->setModel($model);
			$this->setSettings($settings);
			$this->setPath($path);
		}

		function setApp($app) {
			$this->app = strtolower($app);
			$this->setVar('app', $app);
		}
		
		function getApp() {
			return $this->app;
		}
		
		function setController($controller) {
			$this->controller = ucfirst(strtolower($controller));
			$this->setVar('controller', $controller);
		}
			
		function getController() {
			return $this->controller;
		}
		
		function setModel($model) {
			$this->model = ucfirst(strtolower($model));
			$this->setVar('model', $model);
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
			$this->settings = array_extend(
				$this->settings,
				$settings
			);
		}

		function getSettings() {
			return $this->settings;
		}
		
		function setExclude($exclude = array()) {
			$this->exclude = $exclude;
		}
		
		function getExclude() {
			return $this->exclude;
		}
		
		function setMapping($mapping = array()) {
			$this->mapping = array_extend(
				$this->mapping,
				$mapping
			);
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

		function generate() {
			$this->generateController();
		}
		
		function buildSettings() {
			$this->settings['map'] = $this->mapping;			
			$this->settings['exclude'] = $this->exclude;
		}
		
		function generateController() {
			$this->buildSettings();
			
			$template_path = $this->getPath().'/skeleton/{#app#}/controllers';
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
			
				$class .= $this->replace($View->render());
				
				$this->debug('Traitement de '.$file);
			}
			
			$Base = new View($template_path.'/base.tpl.php', null, false);
			$Base->set('protection',	$this->getProtection());
			$Base->set('app', 			$this->getApp());
			$Base->set('controller', 	$this->getController());
			$Base->set('model', 		$this->getModel());
			$Base->set('settings', 		$this->getSettings());
			$Base->set('class', 		$class);
			
			$generated = $Base->render();
			$generated = str_replace('[?', '<?', $generated);
			$generated = str_replace('?]', '?>', $generated);
			$generated = $this->replace($generated);

			$this->debug('Intégration dans base.tpl.php');
			
			$path = ROOT.'/apps/'.strtolower($this->getApp()).'/controllers/'.$this->getController().'.php';

			if (!file_exists(dirname($path))) {
				mkdir(dirname($path), 0700, true);
				$this->debug('Création du dossier '.dirname($path));
			}
			
			if (file_exists($path) && $this->getOverwriteController() === false) {
				$this->debug('Le controller existe déjà. '.$path.' est ignoré.');	
			} else {
				$this->debug('Création du controller '.$path.'.');
				file_put_contents($path, $generated);
			}
		}
	}

	