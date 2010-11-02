<?php
	class View {
		protected $vars 		= array();
		protected $scripts 		= array();
		protected $styles 		= array();
		protected $autorender 	= 1;
		protected $path;
		protected $Layout;
		protected $Controller;
		
		public function __construct($path = null, Layout $Layout = null, $smart = true) {
			$this->Layout = $Layout;
			$this->setPath($path, $smart);
		}

		public function setPath($path, $smart = true) {
			if ($smart) {
				$this->path = VIEWS.'/'.$path.'.tpl.php';			
			} else {
				$this->path = $path;
			}
		}
		
		public function getPath() {
			return $this->path;
		}

		public function setController(Controller $Controller = null) {
			$this->Controller = $Controller;
		}
		
		public function getController() {
			return $this->Controller;
		}
		
		public function setLayout(Layout $Layout = null) {
			$this->Layout = $Layout;
		}
		
		public function getLayout() {
			return $this->Layout;
		}

		public function cancel() {
			$this->autorender = true;
		}
		
		public function setAutorender($autorender) {
			$this->autorender = $autorender;
		}
		
		public function getAutorender() {
			return $this->autorender;
		}
				
		public function set($name, $value = null) {
			if (is_array($name)) {
				foreach($name as $key => $value) {
					$this->vars[$key] = $value;
				}
			} else {
				if ($this->Layout) {
					$this->Layout->set($name, $value);
				}
				$this->vars[$name] = $value;
			}
		}

		public function get($name = null) {
			if (!$name) {
				return $this->vars;
			}
			if (isset($this->vars[$name])) {
				return $this->vars[$name];
			} else {
				return null;	
			}
		}
		public function addScript($path) {
			$this->scripts[] = $path;
			if ($this->Layout) {
				$this->Layout->addScript($path);
			}
			$this->set('SCRIPTS', $this->renderScripts());
		}

		public function addStyle($path) {
			$this->styles[] = $path;	
			if ($this->Layout) {
				$this->Layout->addStyle($path);
			}
			$this->set('STYLES', $this->renderStyles());
		}
		
		public function renderStyles() {
			$css = array();
			foreach($this->styles as $path) {
				if (Config::get('code.xhtml') == true) {
					$css[$path] = '    <link rel="stylesheet" type="text/css" href="'.$path.'" />';
				} else {
					$css[$path] = '    <link rel="stylesheet" href="'.$path.'">';
				}
			}
			return implode("\n", $css)."\n";	
		}
		
		public function renderScripts() {
			$scripts = array();
			foreach($this->scripts as $path) {
				if (Config::get('code.xhtml') == true) {
					$scripts[$path] = '    <script type="text/javascript" src="'.$path.'"></script>';
				} else {
					$scripts[$path] = '    <script src="'.$path.'"></script>';
				}
			}
			return implode("\n", $scripts)."\n";	
		}
		
		public function slot($name, $default = null, $format = null) {
			if (isset($this->vars[$name])) {
				if ($format) {
					return sprintf($format, $this->vars[$name]);	
				}
				return $this->vars[$name];
			}
			return $default;
		}

		public function partial($name, $vars = array(), $smart = true) {
			if ($smart) {
				$path = VIEWS.'/_partials/'.$name.'.tpl.php';
			} else {
				$path = $name;	
			}
			$Partial = new View($path, null, false);
			$Partial->set($vars);
			return $Partial->render();
		}
		
//		public function partial($name, $smart = true) {
//			if ($smart) {
//				$path = VIEWS.'/_partials/'.$name.'.tpl.php';
//			} else {
//				$path = $name;	
//			}
//			return $this->doRender($path);
//		}
	
		public function render() {
			if ($this->Layout) {
				$this->Layout->set('CONTENT', $this->doRender());
				return $this->Layout->doRender();
			}
			return $this->doRender();
		}

		public function spit() {
			echo $this->render();
		}
		
		private function doRender($path = null) {	
			if (!$path) {
				$path = $this->path;
			}
			
			$full_path = $path;	
			
			if (!file_exists($full_path)) {
				throw new Exception("La vue \"".$path."\" n'existe pas");
			}
			
			extract($this->vars);
			ob_start();
			include $full_path;
			$content = ob_get_contents();
			ob_end_clean();	
				
			return $content;
		}
	}