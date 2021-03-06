<?php
	abstract class Generator {
		protected $verbose = true;
		protected $varFormat = '{#%s#}';
		protected $vars;
		protected $path;
		
		function setVerbose($verbose) {
			$this->verbose = $verbose;	
		}

		function getVerbose() {
			return $this->verbose;	
		}

		function setPath($path) {
			$this->path = $path;
		}

		function getPath() {
			return $this->path;
		}

		function setVar($name, $value) {
			$this->vars[$name] = $value;
			$this->vars[ucfirst($name)] = ucfirst($value);
		}

		function getVar($name) {
			return $this->vars[$name] = $value;
		}
		
		function setVars($vars) {
			$this->vars = $vars;
		}
		
		function getVars() {
			return $this->vars;
		}
		
		function setVarFormat($format) {
			$this->varFormat = $format;
		}
		
		function getVarFormat() {
			return $this->varFormat();	
		}
		
		protected function debug($string, $error = false) {
			 if ($this->getVerbose()) {
				 if (!is_cli() && $error) {
    			     $format = '<span style="color:red">%s</span>';
				 } else if (is_cli() && $error) {
    			     $format = '*** %s';
    			 } else {
    			     $format = '%s';
    			 }
				 printf($format, str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', $string));
    			 if (is_cli()) {
    			     echo "\n";
    			 } else {
    			     echo '<br>';
    			 }
			 }
		}

		protected function getTemplates($path) {
            if (!file_exists($path)) {
                $this->debug('Pas de dossier '.$path.' à scanner.');
                return array();
            }
            
			$templates = array();
			
			if (!is_dir($path)) {
			    return $templates;
			}
			
			$handle = opendir($path);
			while ($file = readdir($handle)) {
				if (strpos($file, '.tpl.php') !== false && $file != 'base.tpl.php') {
					$templates[] = $file;
				}
			}
			closedir($handle);
			
			sort($templates);
			return $templates;
		}
		
		// remplaçe les {#vars#} et copie le dossier et son contenu 
		protected function copy($from_dir, $to_dir, $overide = false) {
            if (!file_exists($from_dir)) {
                $this->debug('Pas de dossier '.$from_dir.' à copier.');
                return false;
            }
            
            $files = read_folder($from_dir);
			            
            foreach($files as $file) {
				$from   = $from_dir.'/'.$file;
				$to     = $this->replace($to_dir.'/'.$file);
				
				$this->mkdir(dirname($to));
				
                if (basename($file) == 'empty') {
                    continue;
                }
				
				if (file_exists($to) && $overide === false) {
				 $this->debug('Le fichier existe déjà. '.$to.' est ignoré.', true);    
				} else {
				 $this->debug('Création du fichier '.$to.'.');
				 $content = file_get_contents($from);
				 $content = $this->replace($content);
				 file_put_contents($to, $content);
				}
            }		    
		}

		// Copie le dossier et son contenu sans remplaçer les {#vars#}
		protected function duplicate($from_dir, $to_dir, $overide = false) {
            if (!file_exists($from_dir)) {
                $this->debug('Pas de dossier '.$from_dir.' à copier.');
                return false;
            }
            
            $files = read_folder($from_dir);
            
            foreach($files as $file) {
				$from   = $from_dir.'/'.$file;
				$to     = $to_dir.'/'.$file;
				
				$this->mkdir(dirname($to));
                if (basename($file) == 'empty') {
                    continue;
                }
                
				if (file_exists($to) && $overide === false) {
				 $this->debug('Le fichier existe déjà. '.$to.' est ignoré.', true);    
				} else {
				 $this->debug('Création du fichier '.$to.'.');
				 copy($from, $to);
				}
            }		    
		}
		
		protected function mkdir($path, $mod = 0755) {	
			if (file_exists($path)) {
				return false;
			}
			if (contains('*/cache/*', 	$path.'/')
			||	contains('*/logs/*', 	$path.'/')
			||	contains('*/models/*',	$path.'/')) {
				$mod = 0777;
			}
			mkdir($path, $mod, true);
			$this->debug('Création du dossier '.$path);
		}
		
		protected function replace($content) {
			$vars = $values = array();
			foreach($this->vars as $name => $value) {
				$vars[] 	= sprintf($this->varFormat, $name);
				$values[] 	= $value;	
			}
			return str_replace($vars, $values, $content);
		}
	}

