<?php
	class GeneratorController extends Generator {
		protected $app, $controller, $model;
		protected $protection 	= true;
		protected $overwrite 	= false;

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
				
		function __construct($controller, $app, $model = null, $path = '.') {
			$this->setApp($app);
			$this->setController($controller);
			$this->setModel($model);
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
			$this->generateViews();			
			$this->generateStructure();
		}

		function generateController() {	
			$template_path = $this->getPath().'/controller';
			$templates = $this->getTemplates($template_path);
			$class = '';
			
			$this->debug('---------------------------------');
			$this->debug('Controller '.$this->getController());
			$this->debug('---------------------------------');
			
			foreach($templates as $file) {
				if (!preg_match('~^[1-9]+[9]*~', $file)) { // ne prend que ce qui commence par 1 à 99
					continue;	
				}
				$tmp = $this->getTempFile($template_path.'/'.$file);
				
				$View = new View($tmp, null, false);
				$View->set('app', 			$this->getApp());
				$View->set('controller', 	$this->getController());
				$View->set('model', 		$this->getModel());
				$View->set('protection',	$this->getProtection());
				$View->set('exclude', 		$this->getExclude());
				$View->set('mapping', 		$this->getMapping());
				
				$class .= $this->replace($View->render());
				
				$this->debug('Traitement de '.$file);
			}

			$base = $this->getTempFile($template_path.'/base.tpl.php');
				
			$Base = new View($base, null, false);
			$Base->set('app', 			$this->getApp());
			$Base->set('controller', 	$this->getController());
			$Base->set('model', 		$this->getModel());
			$Base->set('protection',	$this->getProtection());
			$Base->set('exclude', 		$this->getExclude());
			$Base->set('mapping', 		$this->getMapping());
			$Base->set('class', 		$class);
			
			$generated = $Base->render();
			$generated = str_replace('[?', '<?', $generated);
			$generated = str_replace('?]', '?>', $generated);
			$generated = $this->replace($generated);

			$this->debug('Intégration des méthodes dans la classe');
			
			$path = ROOT.'/apps/'.strtolower($this->getApp()).'/controllers/'.$this->getController().'.php';

			if (!file_exists(dirname($path))) {
				mkdir(dirname($path), 0700, true);
				$this->debug('Création du dossier '.dirname($path));
			}
			
			if (file_exists($path) && $this->getOverwrite() === false) {
				$this->debug('Le controller existe déjà. '.$path.' est ignoré.');	
			} else {
				$this->debug('Création du controller '.$path.'.');
				file_put_contents($path, $generated);
			}
		}

		function generateViews() {
			$template_path = $this->getPath().'/views';
			$templates = $this->getTemplates($template_path);

			$this->debug('---------------------------------');
			$this->debug('Vues pour le controller '.$this->getController());
			$this->debug('---------------------------------');
				
			foreach($templates as $file) {
				$tmp = $this->getTempFile($template_path.'/'.$file);
				
				$View = new View($tmp, null, false);
				$View->set('app', 			$this->getApp());
				$View->set('controller', 	$this->getController());
				$View->set('model', 		$this->getModel());
				$View->set('protection',	$this->getProtection());
				$View->set('exclude', 		$this->getExclude());
				$View->set('mapping', 		$this->getMapping());
			
				$generated = $View->render();
				$generated = str_replace('[?', '<?', $generated);
				$generated = str_replace('?]', '?>', $generated);
				$generated = $this->replace($generated);

				$path = ROOT.'/apps/'.strtolower($this->getApp()).'/views/'.strtolower($this->getController()).'/'.$file;

				if (!file_exists(dirname($path))) {
					mkdir(dirname($path), 0700, true);
					$this->debug('Création du dossier '.dirname($path));
				}
				
				if (file_exists($path) && $this->getOverwrite() === false) {
				    $this->debug('La vue existe déjà. '.$path.' est ignoré.', true);		
				} else {
					$this->debug('Création de la vue '.$path.'.');
					file_put_contents($path, $generated);
				}
			}
		}

		function generateStructure() {
			$this->debug('---------------------------------');
			$this->debug('Structure');
			$this->debug('---------------------------------');

            $from   = $this->getPath().'/skeleton';
            $to     = ROOT;
            
            $this->copy($from, $to, $this->getOverwrite());
		}
		
		private function getTempFile($path) {
			$content = file_get_contents($path);
			$content = $this->replace($content);		

			$tmp = tempnam('', '');
			file_put_contents($tmp, $content);
			
			return $tmp;
		}
	}

	