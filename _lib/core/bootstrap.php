<?php
	class BootstrapCore {
		protected $path 	= array();
		protected $models 	= array();
		protected $default 	= 'default/index/';
		protected $env;
		
		static public $instance;
		
		public static function getInstance() {
			if (!isset(self::$instance)) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct() {
			spl_autoload_register(array('Doctrine', 'autoload'));
			spl_autoload_register(array($this, 'autoload'));
		}
		
		private function autoload($classname) {
			$prefix = array(
				'/(.+)Core$/' 		=> '\1',
				'/(.+)Controller$/' => '\1',
				'/(.+)Helper$/' 	=> '\1',
				'/(.+)Component$/' 	=> '\1'
			);
			
			$filename = preg_replace(array_keys($prefix), $prefix, $classname).'.php';		
					
			foreach($this->getAutoloadPath() as $folder) {
				$path = $folder.$filename;
				if (file_exists($path)) {
					require_once $path;
					if (class_exists($classname)) {
						break;
					}
				}
			}
		}
		
		public function addAutoloadPath($path) {
			$this->path[] = $path;
		}
		
		public  function getAutoloadPath() {
			return $this->path;
		}
		
		public  function setEnv($env) {
			$this->env = $env;
		}
		
		public  function getEnv() {
			return $this->env;	
		}
		
		public  function setDefaultController($url) {
			$this->default = $url;
		}
		
		public  function loadConfigs($path) {
			require_once($path.'config.php');
			
			if (!$this->env) {
				throw new Exception("Un environnement doit être configuré avant l'appel de cette méthode.");	
			}
			
			if (!isset($configs['default'])) {
				throw new Exception("Le fichier de configuration ne semble pas être correct.");
			}
			
			foreach($configs['default'] as $key => $value) {
				Config::set($key, $value);				
			}
			
			foreach($configs[$this->env] as $key => $value) {
				Config::set($key, $value);				
			}
		}
			
		public  function addModelPath($path) {
			$this->models[] = $path;
		}
		
		public  function setDoctrine() {
			if (!$configs = Config::get()) {
				throw new Exception("Les configuration doit être configurées avant l'appel de cette méthode.");	
			}
			if (empty($this->models)) {
				throw new Exception("Les chemins des modèles doivent être configurés avant l'appel de cette méthode.");	
			}
			$manager = Doctrine_Manager::getInstance();
			
			$pdo	= new PDO('mysql:dbname='.Config::get('db.name').';host='.Config::get('db.host'), Config::get('db.username'), Config::get('db.password'));
			$conn 	= Doctrine_Manager::connection($pdo, 'default');
			$conn->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
		
			foreach($this->models as $model_path) {
				Doctrine_Core::loadModels($model_path);
			}
		}
				
		public  function dispatch($url = null) {
			if (!$url && isset($_GET['URL'])) {
				$url = $_GET['URL'];
			}
			if (!$url) {
				$url = $this->default;	
			}
			
			unset($_GET['URL']);
			unset($_GET['LANG']);
			
			$dispatcher = Dispatcher::getInstance($url);
			$dispatcher->dispatch();
		}
		
		public function __destruct() {
			Doctrine_Manager::connection()->close();
		}
	}