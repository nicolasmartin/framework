<?php
	class Bootstrap {
		protected $path 		= array();
		protected $models 		= array();
		protected $default 		= 'default/index';
		protected $dispatching 	= true;
		protected $env;
		
		static public $instance;
		
		public static function getInstance() {
			if (!isset(self::$instance)) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct() {
			spl_autoload_register(array($this, 'autoload'));
			
			$this->path[] = dirname(__FILE__).'/../components';
			$this->path[] = dirname(__FILE__).'/../helpers';
		}
		
		private function autoload($classname) {
			if (preg_match('~^Doctrine~', $classname)) {
				return false;				
			}
			
			$prefix = array(
				'/(.+)Core$/' 		=> '\1',
				'/(.+)Controller$/' => '\1',
				'/(.+)Helper$/' 	=> '\1',
				'/(.+)Component$/' 	=> '\1'
			);
			
			$filename = preg_replace(array_keys($prefix), $prefix, $classname).'.php';		
					
			foreach($this->getAutoloadPath() as $folder) {
				$path = $folder.'/'.$filename;

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

		public function disableDispatch() {
			$this->dispatching = false;	
		}
		
		public function enableDispatch() {
			$this->dispatching = true;	
		}

		public  function setDefaultPath($path) {
			$this->default = $path;
		}

		public  function getDefaultPath() {
			return $this->default;
		}

		public  function loadConfigs($path) {
			require_once($path.'/config.php');
			
			if (!$this->env) {
				throw new Exception("Un environnement doit être configuré avant l'appel de cette méthode.");	
			}
			
			if (!isset($configs['default'])) {
				throw new Exception("Le fichier de configuration ne semble pas être correct.");
			}
			
			foreach($configs['default'] as $key => $value) {
				Config::set($key, $value);				
			}
			
			if (isset($configs[$this->env])) {
				foreach($configs[$this->env] as $key => $value) {
					Config::set($key, $value);				
				}
			}
		}
			
		public  function addModelPath($path) {
			$this->models[] = $path;
		}
		
		public  function setDoctrine() {
			spl_autoload_register(array('Doctrine', 'autoload'));

			if (!$configs = Config::get()) {
				throw new Exception("Les configurations doit être chargées avant l'appel de cette méthode.");	
			}
			if (empty($this->models)) {
				throw new Exception("Les chemins des modèles doivent être configurés avant l'appel de cette méthode.");	
			}
			
			if (Config::get('db.name')) {
				$Conn = Doctrine_Manager::connection(array('mysql:dbname='.Config::get('db.name').';host='.Config::get('db.host'), 
				    Config::get('db.username'), 
				    Config::get('db.password')
				    ), 
				    'default');

				$Conn->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);	
				$Conn->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true); 
				$Conn->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
				$Conn->setAttribute(Doctrine::ATTR_QUOTE_IDENTIFIER, true);
				
				foreach($this->models as $model_path) {
					Doctrine::loadModels($model_path);
				}
			}
		}
				
		public  function dispatch($url = null) {
			if ($this->dispatching == false) {
				return false;
			}
			
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
		    if (!class_exists('Doctrine_Manager')) {
		        return;
		    }
			try {
			    Doctrine_Manager::connection()->close();
			} catch(Exception $e) {}
		}
	}