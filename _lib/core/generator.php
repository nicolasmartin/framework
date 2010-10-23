<?php
	abstract class Generator {
		protected $verbose = true;

		function setVerbose($verbose) {
			$this->verbose = $verbose;	
		}

		function getVerbose() {
			return $this->verbose;	
		}
		
		protected function debug($string) {
			 if(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR'])) {
				  $nl = "\n";
			 } else {
				  $nl = "<br />";
			 }
			 if ($this->getVerbose()) {
				 echo str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', $string), $nl;
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
			
			return $templates;
		}
		
		
		protected function copy($from_dir, $to_dir, $overide = false) {
            if (!file_exists($from_dir)) {
                $this->debug('Pas de dossier '.$from_dir.' à copier.');
                return false;
            }
            
            $files = read_folder($from_dir);
            
            foreach($files as $file) {
                 $from   = $from_dir.'/'.$file;
                 $to     = $to_dir.'/'.$file;
 
                 if (!file_exists(dirname($to))) {
                     mkdir(dirname($to), 0700, true);
                 }
 
                 if (file_exists($to) && $overide === false) {
                     $this->debug('Le fichier existe déjà. '.$to.' est ignoré.');    
                 } else {
                     $this->debug('Création du fichier '.$to.'.');
                     copy($from, $to);
                 }
            }		    
		}
	}

