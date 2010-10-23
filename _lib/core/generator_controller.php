<?php
	class GeneratorController extends Generator {
		protected $app, $controller, $model;
		protected $protection 			= true;
		protected $packs 				= array();
		protected $overwriteController 	= false;
		protected $overwriteViews 		= false;
		protected $overwritePartials 	= false;

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
			'width'			=> "largeur",
			'height'		=> "hauteur",
			'created_at'	=> "créé",
			'updated_at'	=> "mis à jour",
		);
				
		function __construct($app = null, $controller = null, $model = null, $path = '.', $settings = array()) {
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
			$this->settings = array_extend(
				$this->settings,
				$settings
			);
		}

		function getSettings() {
			return $this->settings;
		}
		
		function setExclude($exclude = array()) {
			$this->exclude = array_extend(
				$this->exclude,
				$exclude
			);
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
		
		function setOverwriteAll($overwrite) {
			$this->overwriteController 	= $overwrite;
			$this->overwriteViews 		= $overwrite;
			$this->overwritePartials 	= $overwrite;
		}

		function setOverwriteController($overwrite) {
			$this->overwriteController = $overwrite;
		}
		
		function getOverwriteController() {
			return $this->overwriteController;
		}

		function setOverwriteViews($overwrite) {
			$this->overwriteViews = $overwrite;
		}
		
		function getOverwriteViews() {
			return $this->overwriteViews;
		}
		
		function setOverwritePartials($overwrite) {
			$this->overwritePartials = $overwrite;
		}
		
		function getOverwritePartials() {
			return $this->overwritePartials;
		}
			
		function addPack($pack) {
			$this->packs[$pack] = $pack;
		}
		
		function removePack($pack) {
			if (isset($this->packs[$pack])) {
				unset($this->packs[$pack]);
			}
		}

		function generateAll() {
			$this->generateController();
			$this->generateViews();
			$this->generatePartials();
		}
		
		function buildSettings() {
			$this->settings['map'] = $this->mapping;			
			$this->settings['exclude'] = $this->exclude;
		}
		
		function generateController() {
			$this->buildSettings();
			
			$template_path = $this->getPath().'/controller';
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
		
		function generateViews() {
			$this->buildSettings();

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
			
				$path = ROOT.'/apps/'.strtolower($this->getApp()).'/views/'.strtolower($this->getController()).'/'.$file;

				foreach($this->packs as $pack) {
					$dir = strtolower($this->getController());
					$path = preg_replace('~/'.$dir .'/'.$pack.'/~', '/'.$dir.'/', $path);
				}

				if (!file_exists(dirname($path))) {
					mkdir(dirname($path), 0700, true);
					$this->debug('Création du dossier '.dirname($path));
				}
				
				if (file_exists($path) && $this->getOverwriteViews() === false) {
				    $this->debug('La vue existe déjà. '.$path.' est ignoré.');		
				} else {
					$this->debug('Création de la vue '.$path.'.');
					file_put_contents($path, $generated);
				}
			}
		}

		function generatePartials() {
			$this->buildSettings();

			$template_path = $this->getPath().'/partials';
			$templates = $this->getTemplates($template_path);

			$this->debug('---------------------------------');
			$this->debug('Partiels pour le controller '.$this->getController());
			$this->debug('---------------------------------');
				
			foreach($templates as $file) {
				$View = new View($template_path.'/'.$file, null, false);
				$View->set('app', 			$this->getApp());
				$View->set('controller', 	$this->getController());
				$View->set('model', 		$this->getModel());
				$View->set('settings', 		$this->getSettings());
			
				$generated = $View->render();
				$generated = str_replace('[?', '<?', $generated);
				$generated = str_replace('?]', '?>', $generated);
			
				$path = ROOT.'/apps/'.strtolower($this->getApp()).'/views/_partials/'.$file;
				
				foreach($this->packs as $pack) {
					$dir = '_partials';
					$path = preg_replace('~/'.$dir .'/'.$pack.'/~', '/'.$dir.'/', $path);
				}

				if (!file_exists(dirname($path))) {
					mkdir(dirname($path), 0700, true);
					$this->debug('Création du dossier '.dirname($path));
				}

				if (file_exists($path) && $this->getOverwritePartials() === false) {
				    $this->debug('Le partiel existe déjà. '.$path.' est ignoré.');		
				} else {
					$this->debug('Création du partiel '.$path.'.');
					file_put_contents($path, $generated);
				}
			}
		}
		
		function getTemplates($path) {
		    $templates = parent::getTemplates($path);
		    
		    foreach($this->packs as $pack) {
				$path = $path.'/'.$pack;
				if (is_dir($path)) {
				    $pack_templates = parent::getTemplates($path);
				    
					foreach($pack_templates as $template) {
    					$templates[] = $pack.'/'.$template;					    
					}
				}
			}
			
			return $templates;
		}
	}

	