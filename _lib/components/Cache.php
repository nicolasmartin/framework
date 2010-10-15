<?php
    class CacheComponent extends Component {
		public $lifetime; 
		private $filename;
		private $params;

		public function __construct($filename, $lifetime = 60) { 
			if (!is_numeric($lifetime)) {
				$lifetime = strtotime($lifetime);
			}
			$this->lifetime = $lifetime;  
			$this->filename = $filename;            
		}     

		public function open() { 
			if (file_exists($this->filename) && (time() - filemtime($this->filename)) < $this->lifetime*60) { 
				if ($info = getimagesize($this->filename)) {
					header('Content-type: '.$info['mime']);
				}
				
				readfile($this->filename); 
				exit; 
			} 
			ob_start(); 
		} 

		public function close() { 
			$content = ob_get_contents(); 
			ob_end_clean (); 

			$fp = fopen($this->filename, "w"); 
			fwrite($fp, $content); 
			fclose($fp); 

			echo $content; 
		}
	}